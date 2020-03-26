<<!--section id="faq">
    <div class="container pt-5">
        <div class="text-center pt-5 pb-5">
            <h2>Preguntas frecuentes</h2>
            <hr>
        </div>
    </div>
    <div class="container">
        <?php
        $preguntas_frecuentes_file = fopen("content/preguntas_frecuentes.json", "r") or die("Unable to open file!");
        $preguntas_frecuentes_json = fread($preguntas_frecuentes_file, filesize("content/preguntas_frecuentes.json"));
        fclose($preguntas_frecuentes_file);
        $categorias_con_preguntas_frecuentes = json_decode($preguntas_frecuentes_json, TRUE);
        ?>
        <div class="row">
            <div class="col-md-6">
                <?php for ($i = 0; $i < 3; $i++) { ?>
                    <?php $categoria = $categorias_con_preguntas_frecuentes[$i]; ?>
                    <h3><?php echo $categoria['categoria']; ?></h3>
                    <?php foreach ($categoria['preguntas'] as $pregunta) { ?> 
                        <div class="div-massiva-container mt-2">
                            <div class="div-massiva-header pointer">
                                <i class="fas fa-plus-circle float-right"></i>
                                <i class="fas fa-minus-circle float-right"></i>
                                <h4><?php echo $pregunta['pregunta']; ?></h4>
                            </div>
                            <div class="div-massiva-body">
                                <?php echo $pregunta['respuesta']; ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-md-6">
                <?php for ($i = 3; $i < count($categorias_con_preguntas_frecuentes); $i++) { ?>
                    <?php $categoria = $categorias_con_preguntas_frecuentes[$i]; ?>
                    <h3><?php echo $categoria['categoria']; ?></h3>
                    <?php foreach ($categoria['preguntas'] as $pregunta) { ?>
                        <div class="div-massiva-container mt-2">
                            <div class="div-massiva-header pointer">
                                <i class="fas fa-plus-circle float-right"></i>
                                <i class="fas fa-minus-circle float-right"></i>
                                <h4><?php echo $pregunta['pregunta']; ?></h4>
                            </div>
                            <div class="div-massiva-body">
                                <?php echo $pregunta['respuesta']; ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section-->