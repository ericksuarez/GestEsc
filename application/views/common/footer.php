
</div>
</div>
</div>
<?php
/*
 * Carga del modal genrico que siempre llama a una vista del catalogo 
 */
$this->load->view('modal/modal_generico');
?>
<!-- Inline Script for colors and config objects; used by various external scripts; -->
<script>
    var colors = {
        "danger-color": "#e74c3c",
        "success-color": "#81b53e",
        "warning-color": "#f0ad4e",
        "inverse-color": "#2c3e50",
        "info-color": "#2d7cb5",
        "default-color": "#6e7882",
        "default-light-color": "#cfd9db",
        "purple-color": "#9D8AC7",
        "mustard-color": "#d4d171",
        "lightred-color": "#e15258",
        "body-bg": "#f6f6f6"
    };
    var config = {
        theme: "layout",
        skins: {
            "default": {
                "primary-color": "#16ae9f"
            }
        }
    };
</script>

<script src="<?php echo base_url() ?>bootstrap/js/vendor/all.js"></script>
<script src="<?php echo base_url() ?>bootstrap/js/app/app.js"></script>
<script src="<?php echo base_url() ?>printPage/jquery.printPage.js"></script>
<script src="<?php echo base_url() ?>ajax/Direccion.js"></script>
<?php if(isset($add_js)){
foreach($add_js as $k => $js){?>
<script src="<?php echo base_url() ?>ajax/<?php echo $js?>.js"></script>
<?php }}?>
<script>
$(document).ready(function () {
  $(".btnPrint").printPage();  
  $('#example').DataTable();
});
</script>
</body>

</html>
