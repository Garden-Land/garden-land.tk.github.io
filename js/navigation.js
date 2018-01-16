<script type="text/javascript" charset="windows-1251">

var AjaxContent = function(){
var container_div = '';
var content_div = '';
return {
getContent : function(url){
    $(container_div).animate({opacity:0}, //Прозрачность на 0
        function(){ // загружает контент с помощью ajax
        $('#gif_loader').show(); //показываем лоадер
        $(container_div).load(url+" "+content_div, //загружает только выбранную часть
        function(){
            $(container_div).animate({opacity:1}); //возвращает прозрачность обратно на  1
            $('#gif_loader').hide();  //скрываем лоадер при загрузке
            }
        );
    });
},
ajaxify_links: function(elements){
    $(elements).click(function(){
        AjaxContent.getContent(this.href);
        return false; //предотвращает нажатие на ссылку
    });
},
init: function(params){ //задает первоначальные настройки
    container_div = params.containerDiv;
    content_div = params.contentDiv;
    return this; //выводит объект
    }
    }
}();

</script>
<script type="text/javascript" charset="windows-1251">
    $(function(){
        AjaxContent.init({containerDiv:"#ajax-wrap",contentDiv:"#text"}).ajaxify_links("#ajaxgo a");
    });
    </script>