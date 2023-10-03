
$(document).ready(function(){
    $("input[type='checkbox']").change(function(){
        $.ajax({
            'url': '/task/mark/complete',
            'method' : 'post',
            'data': {
                id:$(this).data('id')
            },
            success:(function(response){
                location.reload(true);
            })
        })
    })
    $("#goBack").click(function(){
        history.back();
    })
   

    const curr_date = new Date();
    $('.due_date').each(function(index){
        const due_date = new Date($(this).html());
        if(curr_date.getTime() > due_date.getTime()){
            $(this).append(" <span class='badge bg-danger'>expired<span>");
        }
    })

    $(".mode-toggle").click(function(){
        var modeId = $(this).attr('data-id')
        if(modeId == 1){
            $(this).attr('data-id', 2)
            $(this).html('light mode')
            
        } else{
            $(this).attr('data-id', 1)
            $(this).html('dark mode')
            $(':root').css({'--background-color': "#2222", '--font-color': '#fff'})
        }
       
    })
})
 