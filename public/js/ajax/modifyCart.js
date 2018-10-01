function modifyCart(route, id){
    
    $.post(  route,
    {
      '_token': $('meta[name=csrf-token]').attr('content'),
      item: id
    },
    function(data,status){
        console.log(data);
    });
};
