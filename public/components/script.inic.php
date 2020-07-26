
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
  
  if ($("#card-message").length) { 
  	setTimeout(()=> { 
        $("#card-message").hide();
    }, 2500);

    clearTimeout();
  }

  const readURL = (input) =>{
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            document.getElementById('imagem').innerHTML = input.files[0]['name'];
        };
        reader.readAsDataURL(input.files[0]);
    }
  }

  const confirmDialog = (title, content, link) =>{
    $.confirm({
        title: title,
        content:content,
        closeIcon: true,
        draggable: false,
        icon: 'fa fa-warning',
        buttons: {
          Cancelar:{
            action: function(){}
          },
          Excluir:{
            btnClass: 'btn-blue',
            action: function(){
               window.location.href = link
             }
          }
        }
    });
  }

  const resetDatabase = ()=>{
    $.confirm({
        icon: 'fa fa-warning',
        type: 'red',
        closeIcon: true,
        draggable: false,
        title: 'Limpar banco de dados.',
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>Digite a senha para limpar o banco dados?</label>' +
        '<input type="text"  class="senha form-control" required />' +
        '</div>' +
        '</form>',
        buttons: {
            Cancelar: function () {},
            formSubmit: {
                text: 'Resetar',
                btnClass: 'btn-red',
                action: function () {
                    let senha = this.$content.find('.senha').val();

                    if(!senha){
                        $.alert('Senha não foi informada!');
                        return false;
                    }

                    window.location.href  = '/administradores/clear/' + senha;
                }
            },
        },
    });
  }

  const alterarDescricaoSimbolo = (id,desc,tipo)=>{
    document.getElementById('editlistsimbolo').action = "/simbolos/item-alterar/" + id;
    document.getElementById('descSimboloEdir').innerHTML = desc;
    document.getElementById('tipoListedit').innerHTML = tipo;
    $('#simbolo').modal('toggle');
  }

</script>