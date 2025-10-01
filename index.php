<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer l'arrière-plan d'une image</title>
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
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        input[type="file"] {
            padding: 10px;
            margin: 10px 0;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Supprimer l'arrière-plan d'une image</h1>
    <div class="form-container">
        <form action="process.php" method="post" enctype="multipart/form-data">
            <label for="image">Choisis une image (JPG, PNG, etc.) :</label><br>
            <input type="file" name="image" id="image" accept="image/*" required><br>
            <button type="submit">Supprimer l'arrière-plan</button>
        </form>
    </div>
</body>
</html>