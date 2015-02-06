/**
 * Created by gabriel on 06/02/15.
 */
function setAttributes()
{
    $("#advisr-recommendations").css('border-style', "solid" );
    $("#advisr-recommendations").css('border-width', $("#border_width").val() + "px" );
    $("#advisr-recommendations").css('border-color', "#" + $("#border_color").val() );
    $("#advisr-recommendations").css('width', $("#box_width").val() + "px" );

    var cloned = $("#advisr-recommend");

    $("#advisr-recommendations").html('');
    for(i=1; i<=$("#how_many").val(); i++ ) {
        console.log("DS");
        cloned.clone().appendTo($("#advisr-recommendations"));
    }
    $("#display-box-data").html($("#display-data").serialize());
    //console.log($("#display-data").serialize());
}