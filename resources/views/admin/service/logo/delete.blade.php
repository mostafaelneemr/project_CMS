<div class="modal fade" id="deletedlogo" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete logo from service section</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form action="{{route('logo-section.destroy','test')}}" method="post">
                   @method('DELETE')
                   @csrf
 
                   <input type="hidden" name="logo_id" id="logo_id" value=""> 

                   <div class="row">
                       <div class="col">
                        <label class="text-danger h6">Are you sure delete one logo from service section?</label>
                        <h5>if you deleted this section , you should create new section to service page.</h5>            
                       </div>
                   </div>

                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">cancle</button>
                       <button class="btn btn-primary">comfirm</button>
                   </div>

               </form>
           </div>
       </div>
   </div>
</div>
