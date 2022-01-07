<div>目前位置：首頁 > 分類網誌 > <span id="navTag">健康新知</span></div>
<div style="display:flex">
    <fieldset style="width:20%">
        <legend>分類項目</legend>
      <a><p class="tag" data-type="1">健康新知</p></a>
      <a><p class="tag" data-type="2">菸害防治</p></a>
      <a><p class="tag" data-type="3">癌症防治</p></a>
      <a><p class="tag" data-type="4">慢性病防治</p></a>
    </fieldset>
    <fieldset style="width:70%">
        <legend>文章列表</legend>
        <div id="newslist"></div>
        <div id="news" style="display:none"></div>
    </fieldset>
</div>


<script>
getlist(1)
$(".tag").on('click',function(){
    let navtag=$(this).text()
    $("#navTag").text(navtag)
    let type=$(this).data('type')
    getlist(type)
})
function getlist(type){
    $.get("api/getlist.php",{type},(list)=>{
        $("#newslist").html(list)
        $("#newslist").show()
        $("#news").hide();
    })
}
function getnews(id){
    $.get("api/getnews.php",{id},(news)=>{
        $("#news").html(news)
        $("#news").show()
        $("#newslist").hide()
    })
}
</script>