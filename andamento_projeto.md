#------------------------------------------------------
 Implementação atual
 ------------------------------------------------------
-Migrar site par rothermel.com.br






#------------------------------------------------------
 Pendencias
 ------------------------------------------------------
    -> implementar validação de cpf e cnpj, arquivo com codigo no fonte raiz
    -> revisar ordem de campos do form de inclusão de clientes




#------------------------------------------------------
 Metas a realizar
 ------------------------------------------------------
-cadastro de clientes


#------------------------------------------------------
 Estruturas projeto
 ------------------------------------------------------
    -> Aton-Permissions = Componente que valida prermições atraves de mixins
    -> Aton-Rules = Regras de validação de formularios
    -> Aton-Dialog = Form de validação usado para exclasão de registros
    -> Aton-Progress = Loader de carregamento


componente de upload de videos
https://gist.github.com/dohomi/8f27b14ce5d0c2923ed5c88a55ea582f




#------------------------------------------------------
 Dados existentes na 4yousee e devem constar em novas tabelas para noticias
 ------------------------------------------------------


->>>>>>>>>>>>>>>>>>> link para subdominios <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
https://likegeeks.com/dynamic-laravel-subdomain-routing/





DICAS:

copiar array em novo sem vinculo
this.testArray = this.templateArray.slice()
---------------
  data: {
      testArray: [],
      _templateArray: [{ name: "TEST" }]
  },
  ready: function() {
      this.testArray = this.$data._templateArray;
  }
---------------------------

CRON 

rodar force
php -d disable_functions[] /home1/arjr/public_html/arsig/artisan storage:link
php-cli -d disable_functions[] /home/playvitta/public_html/playvitta/artisan schedule:run