<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <title>Liste des avis</title>
</head>

<body class="w-[1000px] mx-auto font-['Nunito']">

    <?php

        require 'config/db.php';
        require 'config/helpers.php';
    
        $name = sanitize($_POST['name'] ?? null);
        $review = sanitize($_POST['review'] ?? null);
        $note = sanitize($_POST['note'] ?? null);
        
        $errors = [];
        $success = false;

        if (isSubmit()) {
            if (strlen($name) === 0) {
                $errors['name'] = 'Le nom doit être renseigné';
            } elseif (strlen($name) > 30) {
                $errors['name'] = 'Le nom ne peut excéder 30 caractères.';
            }
            
            if (strlen($review) > 250) {
                $errors['name'] = 'Le review ne peut excéder 250 caractères.';
            }
            
            if ($note !== '1' && $note !== '2' && $note !== '3' && $note !== '4' && $note !== '5') {
                $errors['note'] = 'La note est obligatoire';
            }

            if (empty($errors)) {
                insert('INSERT INTO reviews (name, review, note, created_at) VALUES (:name, :review, :note, :created_at)', [
                    'name' => $name,
                    'review' => $review,
                    'note' => $note,
                    'created_at' => date('Y-m-d H:i:s', strtotime('+2 hours'))
                ]);
            }
        }

        $views = select('SELECT * FROM reviews') ?? [];

        function filterViewsByNote($views, $note) {
            return array_filter($views, function ($v) use ($note) {
                return ($v['note'] == $note);
            });
        }

        function getPercentageOfViewsByNote($views, $note) {
            $total = count($views);
            $nbOfNotes = count(filterViewsByNote($views, $note));

            return $nbOfNotes / $total * 100;
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

    <section class="mb-6 border rounded">
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
                <div class="mb-1 w-full flex">
                    <div class="w-[15%] flex">
                        <span class="mr-1">5</span>
                        <svg fill="#ff0" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
                        </svg>
                    </div>
                    <div class="w-[70%] bg-slate-200 rounded">
                        <div class="h-full bg-yellow-400 w-[<?= getPercentageOfViewsByNote($views, 5) ?>%]"></div>
                    </div>
                    <div class="w-[15%] ml-3">(<?= count(filterViewsByNote($views, 5)) ?>)</div>
                </div>
                <div class="mb-1 w-full flex">
                    <div class="w-[15%] flex">
                        <span class="mr-1">4</span>
                        <svg fill="#ff0" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
                        </svg>
                    </div>
                    <div class="w-[70%] bg-slate-200 rounded">
                        <div class="h-full bg-yellow-400 w-[<?= getPercentageOfViewsByNote($views, 4) ?>%]"></div>
                    </div>
                    <div class="w-[15%] ml-3">(<?= count(filterViewsByNote($views, 4)) ?>)</div>
                </div>
                <div class="mb-1 w-full flex">
                    <div class="w-[15%] flex">
                        <span class="mr-1">3</span>
                        <svg fill="#ff0" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
                        </svg>
                    </div>
                    <div class="w-[70%] bg-slate-200 rounded">
                        <div class="h-full bg-yellow-400 w-[<?= getPercentageOfViewsByNote($views, 3) ?>%]"></div>
                    </div>
                    <div class="w-[15%] ml-3">(<?= count(filterViewsByNote($views, 3)) ?>)</div>
                </div>
                <div class="mb-1 w-full flex">
                    <div class="w-[15%] flex">
                        <span class="mr-1">2</span>
                        <svg fill="#ff0" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
                        </svg>
                    </div>
                    <div class="w-[70%] bg-slate-200 rounded">
                        <div class="h-full bg-yellow-400 w-[<?= getPercentageOfViewsByNote($views, 2) ?>%]"></div>
                    </div>
                    <div class="w-[15%] ml-3">(<?= count(filterViewsByNote($views, 2)) ?>)</div>
                </div>
                <div class="mb-1 w-full flex">
                    <div class="w-[15%] flex">
                        <span class="mr-1">1</span>
                        <svg fill="#ff0" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
                        </svg>
                    </div>
                    <div class="w-[70%] bg-slate-200 rounded">
                        <div class="h-full bg-yellow-400 w-[<?= getPercentageOfViewsByNote($views, 1) ?>%]"></div>
                    </div>
                    <div class="w-[15%] ml-3">(<?= count(filterViewsByNote($views, 1)) ?>)</div>
                </div>
            </div>
    
            <div class="w-1/3 text-center">
                <p>Laissez-nous votre avis</p>
                <a class="px-2 py-1 bg-blue-500 rounded inline-block mt-2 text-white" href="#">Noter</a>
            </div>
        </div>
    </section>

    <section class="mb-6 border rounded">
        <h3 class="mb-4 bg-slate-200 pl-2 py-1">Publier un avis</h3>

        <form class="p-4 w-1/2 mx-auto flex flex-col items-center" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3 w-full">
                <label class="w-[100px] inline-block text-end mr-4" for="name">Nom</label>
                <input class="rounded" placeholder="Votre nom" type="text" name="name" id="name">
            </div>
            
            <div class="mb-3 w-full">
                <label class="w-[100px] inline-block text-end mr-4" for="review">Commentaire</label>
                <textarea class="rounded" placeholder="Votre commentaire" name="review" id="review" cols="30" rows="2"></textarea>
            </div>
            
            <div class="mb-3 w-full">
                <label class="w-[100px] inline-block text-end mr-4" for="note">Note</label>

                <input type="radio" value="1" id="note" name="note">
                <span>1</span>
                <input type="radio" value="2" id="note" name="note">
                <span>2</span>
                <input type="radio" value="3" id="note" name="note">
                <span>3</span>
                <input type="radio" value="4" id="note" name="note">
                <span>4</span>
                <input type="radio" value="5" id="note" name="note">
                <span>5</span>
            </div>
            <button class="px-2 py-1 bg-blue-500 rounded inline-block mt-2 text-white">Noter</button>
        </form>
    </section>

    <?php foreach($views as $view) { ?>
        <section class="mb-4">
            <div class="flex">
                <div class="w-[100px]">
                    <div class="bg-yellow-400 flex justify-center items-center rounded-[50%] w-[70px] h-[70px] text-white text-lg"><?= strtoupper(substr($view['name'], 0, 1)) ?></div>
                </div>
                <div class="w-full border rounded">
                    <p class="bg-slate-200 pl-2 py-1"><?= $view['name'] ?></p>
                    <div class="pl-2 pt-2 pb-4">
                        <div><?= $view['note'] ?> / 5</div>
                        <p><?= $view['review'] ?></p>
                    </div>
                    <p class="text-end bg-slate-200 pl-2 py-1 border"><?= dateToFrench($view['created_at'], 'l d F Y \à H\hi') ?></p>
                </div>
            </div>
    </section>
    <?php } ?>

</body>

</html>