<ul>
    <?php
        foreach($dagonderdelen as $onderdeel){
            echo '<li>' . $onderdeel->naam . '</li>';
            echo '<ul>';
            foreach ($onderdeel->opties as $optie){
                echo '<li>' . $optie->optie . '</li>';
            }
            echo '</ul>';
        }
    ?>
</ul>

<div id="accordion">
    <div class="card">

        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Dagonderdeel: <?php echo "Korte activiteit 1" ?> | Begin: <?php echo "12u45" ?> - Eind: <?php echo "15u15" ?>
                </button>
            </h5>
        </div>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><h5>Ping Pong</h5></li>
                    <li class="list-group-item">&nbsp &nbsp Taak 1: Tafels opstellen</li>

                    <li class="list-group-item"><h5>Tennis</h5></li>
                    <li class="list-group-item">&nbsp &nbsp Taak 1: Personeelsleden begleiden</li>
                </ul>
            </div>
        </div>
    </div>
</div>
