<template>
   <div>
      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" v-for="client in clients" v-bind:key="client.id">
              

                <div class="mt-2 bg-blue dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="row"  >
                        <div class="p-6" >

                            <div class="flex items-center"  >
                                 <div class="ml-4 text-lg leading-7 font-semibold">{{client.id}}</div>
                               <div class="ml-4 text-lg leading-7 font-semibold">{{client.profileImage}}</div>
                                <div class="ml-4 text-lg leading-7 font-semibold">{{client.firstName}}</div>
                                <div class="ml-4 text-lg leading-7 font-semibold">{{client.lastName}}</div>
                                <div class="ml-4 text-lg leading-7 font-semibold">{{client.email}}</div>   
                                <div class="ml-4 text-lg leading-7 font-semibold">{{client.dateOfBirth}}</div>
                                <div class="ml-4 text-lg leading-7 font-semibold">{{client.caseDetail}}</div>
                                <div class="ml-4 text-lg leading-7 font-semibold">{{client.dateProfiled}}</div>
                                <div class="ml-4 text-lg leading-7 font-semibold">{{client.primaryLegalCounsel}}</div>
                                <div class="ml-4 text-lg leading-7 font-semibold">{{client.created_at}}</div>

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
          fetchClients(page_url){
              let vm = this;
              page_url= page_url || '/api/clients'
            fetch('api/clients').
            then(data =>data.json()).
            then(res=>{
                console.log(res.data);
                this.clients = res.data;
                vm.makePagination(res.meta, res.links );

            }).catch(err => console.log(err));
          }

         makePagination(meta, links){
           let pagination ={
               current_page: meta.current_page,
               last_page: meta.last_page,
               next_page_url: links.next,
               prev_pageurl: links.prev
           }
           this.pagination = pagination;

         }

      }
  }

</script>