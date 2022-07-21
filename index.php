<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

    <title>Liste des avis</title>
</head>

<body class="w-[1000px] mx-auto">

    <?php

        require 'config/helpers.php';
    
        $name = sanitize($_POST['name'] ?? null);
        $message = sanitize($_POST['message'] ?? null);
        $note = sanitize($_POST['note'] ?? null);
        
        $errors = [];
        $success = false;

        $views = [];

        if (isSubmit()) {
            if (strlen($name) === 0) {
                $errors['name'] = 'Le nom doit être renseigné';
            } elseif (strlen($name) > 30) {
                $errors['name'] = 'Le nom ne peut excéder 30 caractères.';
            }
            
            if (strlen($message) > 250) {
                $errors['name'] = 'Le message ne peut excéder 250 caractères.';
            }
            
            if ($note !== '1' && $note !== '2' && $note !== '3' && $note !== '4' && $note !== '5') {
                $errors['note'] = 'La note est obligatoire';
            }

            if (empty($errors)) {
                array_push($views, [
                    'name' => $name,
                    'message' => $message,
                    'note' => $note,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    ?>

    <h1 class="mt-4 mb-8 text-2xl font-semibold">Ch'ti restaurant</h1>

    <?php if (!empty($errors)) { ?>
        <section class="p-4 border rounded-xl flex justify-center bg-slate-700 text-red-500 flex-col w-1/4 m-4">
            <?php foreach ($errors as $error) { ?>
                <p><?= $error ?></p>
            <?php } ?>
        </section>
    <?php } ?>

    <?php if (!empty($_POST) && empty($errors)) { ?>
        <section class="p-4 border rounded-xl flex justify-center bg-slate-700 text-emerald-500 flex-col w-1/4 m-4">
            <p>Votre avis a été pris en compte.</p>
        </section>
    <?php } ?>

    <section class="mb-6 border">
        <h3 class="mb-4 bg-slate-200 pl-2 py-1">Notre moyenne</h3>

        <div class="flex w-full py-4">
            <div class="text-center w-1/3">
                <p class="text-yellow-400 text-xl">3.3 / 5</p>
                <div class="flex justify-center my-2">
                    <svg fill="#ff0" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
                    </svg>
                    <svg fill="#ff0" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
                    </svg>
                    <svg fill="#ff0" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
                    </svg>
                    <svg fill="#ff0" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
                    </svg>
                    <svg fill="#000" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
                    </svg>
                </div>
                <p>4 avis</p>
            </div>
    
            <div class="w-1/3">
    
            </div>
    
            <div class="w-1/3 text-center">
                <p>Laissez-nous votre avis</p>
                <a class="px-2 py-1 bg-blue-500 rounded inline-block mt-2 text-white" href="#">Noter</a>
            </div>
        </div>
    </section>

    <section class="mb-6 border">
        <h3 class="mb-4 bg-slate-200 pl-2 py-1">Publier un avis</h3>

        <form class="p-4 text-center" action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="name">Nom</label>
                <input type="text" name="name" id="name">
            </div>
            
            <div>
                <label for="message">Commentaire</label>
                <textarea name="message" id="message" cols="30" rows="2"></textarea>
            </div>
            
            <div>
                <label for="note">1</label>
                <input type="radio" value="1" id="note" name="note">
                <label for="note">2</label>
                <input type="radio" value="2" id="note" name="note">
                <label for="note">3</label>
                <input type="radio" value="3" id="note" name="note">
                <label for="note">4</label>
                <input type="radio" value="4" id="note" name="note">
                <label for="note">5</label>
                <input type="radio" value="5" id="note" name="note">
            </div>
            <button class="px-2 py-1 bg-blue-500 rounded inline-block mt-2 text-white">Noter</button>
        </form>
    </section>

    
    <?php if (!empty($views)) { ?>
        <section class="mb-6 border">
            <h3 class="mb-4 bg-slate-200 pl-2 py-1">Les avis</h3>

            <?php foreach($views as $view) { ?>
                <article>
                    <div class="flex">
                        <div class="flex justify-center items-center">
                            <div class="bg-yellow-400 flex justify-center items-center rounded-[50%] w-[50px] h-[50px] text-white text-lg ml-3 mr-8"><?= strtoupper(substr($view['name'], 0, 1)) ?></div>
                        </div>
                        <div>
                            <p><?= $view['name'] ?></p>
                            <p>Note : <?= $view['note'] ?></p>
                            <p><?= $view['message'] ?></p>
                        </div>
                    </div>
                    <p class="text-end"><?= $view['created_at'] ?></p>
                </article>
            <?php } ?>
        </section>
    <?php } ?>

</body>

</html>