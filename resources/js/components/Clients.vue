<template>
   <div>
      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
              

                <div class="mt-8 bg-blue dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">

                    <div class="row">

                        <div class="p-6" >

                            <div class="flex items-center" v-for="client in clients" v-bind:key="client.id"  >

                                <div class="ml-4 text-lg leading-7 font-semibold">{{client.firstName}}</div>   
                                
                            </div>
         
                          
                        </div>


                  
                    </div>


                </div>

         

       </div>
      
   </div>
</template>



<script> 
  export default {

      data(){
          return{
              clients:[],
              client:{
                  id:'',
                  firstName:'',
                  lastName:'',
                  
              },
              client_id: '',
              pagination:{},
              edit:false
          }
      },

      created(){
          this.fetchClients();
      },

      methods: {
          fetchClients(){
            fetch('api/clients').
            then(res =>res.json).
            then(res=>{
                console.log(res.data);
                this.clients = res.data;
            })
          }
      }
  }

</script>