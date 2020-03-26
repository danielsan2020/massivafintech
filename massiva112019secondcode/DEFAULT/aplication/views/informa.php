<?php
$blog_entradas_file = fopen("content/blog_entradas.json", "r") or die("Unable to open file!");
$blog_entradas_json = fread($blog_entradas_file, filesize("content/blog_entradas.json"));
fclose($blog_entradas_file);
$blog_entradas = json_decode($blog_entradas_json, TRUE);

function time_elapsed_string($time_ago) {
    $time_ago_aux = strtotime($time_ago) ? strtotime($time_ago) : $time_ago;
    $time = time() - $time_ago_aux;
    switch ($time) {
        case $time <= 60;
            return 'hace unos momentos';
        case $time >= 60 && $time < 3600;
            return 'hace ' . ((round($time / 60) == 1) ? 'un minuto' : round($time / 60) . ' minutos');
        case $time >= 3600 && $time < 86400;
            return 'hace ' . ((round($time / 3600) == 1) ? 'una hora' : round($time / 3600) . ' horas');
        case $time >= 86400 && $time < 604800;
            return 'hace ' . ((round($time / 86400) == 1) ? 'un dia' : round($time / 86400) . ' dias');
        case $time >= 604800 && $time < 2600640;
            return 'hace ' . ((round($time / 604800) == 1) ? 'una semana' : round($time / 604800) . ' semanas');
        case $time >= 2600640 && $time < 31207680;
            return 'hace ' . ((round($time / 2600640) == 1) ? 'un mes' : round($time / 2600640) . ' meses');
        case $time >= 31207680;
            return 'hace ' . ((round($time / 31207680) == 1) ? 'un a&ntilde;o' : round($time / 31207680) . ' a&ntilde;os');
    }
}
?>
<section>
    <div class="container-fluid">
        <div class="text-center pt-5 pb-5">
            <h2>massiva informa</h2>
            <hr>
        </div>
    </div>
    <div class="owl-carousel">
        <?php foreach ($blog_entradas as $entrada) { ?>
            <div>
                <a href="<?php echo $entrada['url']; ?>" target="_blank">
                    <div class="card">
                        <img class="card-img-top" src="content/blog/<?php echo $entrada['id']; ?>.jpg" alt="<?php echo $entrada['titulo']; ?>" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $entrada['titulo']; ?></h5>
                            <p class="card-text text-right">
                                <small class="text-muted">
                                    <?php echo time_elapsed_string($entrada['created_at']); ?>
                                </small>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</section>