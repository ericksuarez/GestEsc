
</div>
</div>
</div>
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
<?php if (isset($add_js)) {
    foreach ($add_js as $k => $js) {
        ?>
        <script src="<?php echo base_url() ?><?php echo $js ?>"></script>
    <?php }
} ?>
</body>

</html>
