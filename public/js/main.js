
    function quick_add_to_cart(id_product, name, price, options){
          var temp = JSON.parse(options)
          delete temp.xxlVariant
          $.ajax({
            url  : '/adauga_rapid',
            type :  'POST',
            data: 
            {
              id_product : id_product,
              name : name,
              price : price,
              options : temp,
            },
          headers: 
          {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) 
            { 
               if(resp.code == 200)
               {
                  var counts = resp.count_prods;
                 var total = resp.total;
                 $('#nr_prod').text(counts);
                 $('#total_pret').text(total+' lei');
                 Notiflix.Notify.Success('Produs adaugat in cos');
               }
             
            },
            error: function(p1,p2) 
            {
//                 alertify.error(p1.responseJSON.message);
            },
          })
      }

function quick_remove(id_product){
  $.ajax({
            url  : '/sterge_rapid',
            type :  'POST',
            data: 
            {
              id_product : id_product,
            },
          headers: 
          {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) 
            { 
             var counts = resp.count_prods;
            },
            error: function(p1,p2) 
            {
//                 alertify.error(p1.responseJSON.message);
            },
          })
}

function update_cart(id_product){
  $.ajax({
            url  : '/update_card',
            type :  'POST',
            data: 
            {
              id_product : id_product,
            },
          headers: 
          {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) 
            { 
              
            },
            error: function(p1,p2) 
            {
//                 alertify.error(p1.responseJSON.message);
            },
          })
}

function register(){
  axios.post('/register', {
    name: $('#register-name').val(),
    prenume: $('#register-prenume').val(),
    email: $('#register-email').val(),
    password: $('#register-password').val(),
  })
    .then(function(response){
      console.log('then', response)
    })
    .catch(function(response){
      console.log('catch', response)
    })
}

// function register(){
//   $.ajax({
//             url  : '/register',
//             type :  'POST',
//             data: 
//             {
//               name: $('#register-name').val(),
//               prenume: $('#register-prenume').val(),
//               email: $('#register-email').val(),
//               password: $('#register-password').val(),
//             },
//           headers: 
//           {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             success: function(resp) 
//             { 
//               console.log('success', resp)
//             },
//             error: function(resp) 
//             {
//               console.log('error', resp)
//             },
//           })
// }