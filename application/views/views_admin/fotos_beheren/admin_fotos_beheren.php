<ul class="nav nav-tabs">
    <?php foreach($personeelsfeesten as $personeelsfeest){ ?>
            <li class="nav-item">
                <a class="nav-link" href="#" id="jaarId<?php echo $personeelsfeest->id ?>" data-jaarid="<?php echo $personeelsfeest->id ?>"><?php echo date_format($personeelsfeest->datum, "Y") ?></a>
            </li>
    <?php } ?>
</ul>
<div class="" id="fotoContainer">
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<script>
    function ajax_haalSpecifiekeFotosOp(id){
        $.ajax({
            url: "Foto_beheren/haalAjaxOp_Foto/" + id,
            success: function (data) {
                $("#fotoContainer").empty().append(data);
            }
        });
    }

    $(document).ready(function() {
        $(".nav-link").on('click', function(){
            $(".nav-link.active").removeClass("active");
            $(this).addClass("active");
            ajax_haalSpecifiekeFotosOp($(this).data("jaarid"));
        });

        var jaarIdToClick = Number(<?php echo $jaarIdToClick ?>);
        $("#jaarId" + jaarIdToClick).trigger('click');
    });
</script>