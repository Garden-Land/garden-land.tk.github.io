<script type="text/javascript" charset="windows-1251">

var AjaxContent = function(){
var container_div = '';
var content_div = '';
return {
getContent : function(url){
    $(container_div).animate({opacity:0}, //������������ �� 0
        function(){ // ��������� ������� � ������� ajax
        $('#gif_loader').show(); //���������� ������
        $(container_div).load(url+" "+content_div, //��������� ������ ��������� �����
        function(){
            $(container_div).animate({opacity:1}); //���������� ������������ ������� ��  1
            $('#gif_loader').hide();  //�������� ������ ��� ��������
            }
        );
    });
},
ajaxify_links: function(elements){
    $(elements).click(function(){
        AjaxContent.getContent(this.href);
        return false; //������������� ������� �� ������
    });
},
init: function(params){ //������ �������������� ���������
    container_div = params.containerDiv;
    content_div = params.contentDiv;
    return this; //������� ������
    }
    }
}();

</script>
<script type="text/javascript" charset="windows-1251">
    $(function(){
        AjaxContent.init({containerDiv:"#ajax-wrap",contentDiv:"#text"}).ajaxify_links("#ajaxgo a");
    });
    </script>