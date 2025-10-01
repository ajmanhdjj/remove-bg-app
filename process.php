<?php
     require_once 'config.php';
     
     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
         $uploadDir = 'uploads/';
         // Créer le dossier uploads s'il n'existe pas
         if (!is_dir($uploadDir)) {
             mkdir($uploadDir, 0777, true);
         }
         $originalFile = $uploadDir . uniqid('img_') . '_' . basename($_FILES['image']['name']);
         $fileType = strtolower(pathinfo($originalFile, PATHINFO_EXTENSION));
         
         // Vérifications de sécurité
         $check = getimagesize($_FILES['image']['tmp_name']);
         if ($check === false) {
             die("Erreur : Ce n'est pas une image valide.");
         }
         
         if (!in_array($fileType, ['jpg', 'jpeg', 'png'])) {
             die("Erreur : Seuls les formats JPG, JPEG et PNG sont acceptés.");
         }
         
         if ($_FILES['image']['size'] > 5000000) {
             die("Erreur : L'image est trop grande (max 5MB).");
         }
         
         // Uploader l'image
         if (move_uploaded_file($_FILES['image']['tmp_name'], $originalFile)) {
             // Appeler l'API Remove.bg
             $apiKey = REMOVE_BG_API_KEY; // Utilise la constante de config.php
             $ch = curl_init('https://api.remove.bg/v1.0/removebg');
             curl_setopt($ch, CURLOPT_POST, 1);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, [
                 'image_file' => new CURLFile($originalFile),
                 'size' => 'auto' // Qualité automatique
             ]);
             curl_setopt($ch, CURLOPT_HTTPHEADER, [
                 'X-Api-Key: ' . $apiKey
             ]);
             
             $response = curl_exec($ch);
             $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
             $curlError = curl_error($ch);
             curl_close($ch);
             
             if ($httpCode === 200 && !$curlError) {
                 // Sauvegarder l'image sans fond
                 $outputFile = $uploadDir . 'no-bg-' . uniqid('img_') . '.png';
                 file_put_contents($outputFile, $response);
                 
                 // Afficher le résultat
                 ?>
                 <!DOCTYPE html>
                 <html lang="fr">
                 <head>
                     <meta charset="UTF-8">
                     <meta name="viewport" content="width=device-width, initial-scale=1.0">
                     <title>Résultat - Image sans arrière-plan</title>
                     <style>
                         body {
                             font-family: Arial, sans-serif;
                             max-width: 800px;
                             margin: 0 auto;
                             padding: 20px;
                             background-color: #f4f4f4;
                             text-align: center;
                         }
                         h1 {
                             color: #333;
                         }
                         .image-container {
                             display: flex;
                             justify-content: space-around;
                             margin: 1px 0;
                         }
                         .image-container img {
                             max-width: 300px;
                             border: 1px solid #ddd;
                             border-radius: 5px;
                         }
                         a {
                             display: inline-block;
                             margin: 10px;
                             padding: 10px 20px;
                             background-color: #007bff;
                             color: white;
                             text-decoration: none;
                             border-radius: 5px;
                         }
                         a:hover {
                             background-color: #0056b3;
                         }
                     </style>
                 </head>
                 <body>
                     <h1>Résultat</h1>
                     <div class="image-container">
                         <div>
                             <p>Image originale :</p>
                             <img src="<?php echo htmlspecialchars($originalFile); ?>" alt="Originale">
                         </div>
                         <div>
                             <p>Image sans arrière-plan :</p>
                             <img src="<?php echo htmlspecialchars($outputFile); ?>" alt="Sans fond">
                         </div>
                     </div>
                     <a href="<?php echo htmlspecialchars($outputFile); ?>" download>Télécharger l'image sans fond</a>
                     <a href="index.php">Retour au formulaire</a>
                 </body>
                 </html>
                 <?php
             } else {
                 $error = json_decode($response, true);
                 $errorMessage = $curlError ?: ($error['errors'][0]['title'] ?? 'Erreur inconnue');
                 die("Erreur API : $errorMessage (Code HTTP : $httpCode)");
             }
         } else {
             die("Erreur lors de l'upload de l'image.");
         }
     } else {
         die("Aucune image uploadée.");
     }
     ?>