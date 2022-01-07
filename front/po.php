<div>
    目前位置:首頁 > 分類網誌 > <span id="navTag"></span>
</div>
<div style="display:flex">
    <fieldset style="width: 20%">
        <legend>分類項目</legend>
        <a><p class="tag">健康新知</p></a>
        <a><p class="tag">菸害防治</p></a>
        <a><p class="tag">癌症防治</p></a>
        <a><p class="tag">慢性病防治</p></a>
    </fieldset>
    <fieldset style="width: 75%">
        <legend>文章列表</legend>

    </fieldset>
</div>
<script>
    $(".tag").on("click",function(){
        let navtag=$(this).text();
        $("#navTag").text(navtag);
    });
</script>