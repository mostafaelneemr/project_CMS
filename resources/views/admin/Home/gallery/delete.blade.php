<div class="modal fade" id="deletedportfolio" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete one picture from portfolio section</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form action="{{route('gallery-section.destroy','test')}}" method="post">
                   @method('DELETE')
                   @csrf
 
                   <input type="hidden" name="pic_id" id="pic_id" value=""> 

                   <div class="row">
                       <div class="col">
                        <label class="text-danger h6">Are you sure delete picture from gallery?</label>
                        <h5>if you deleted this picture , you should create new picture to home page.</h5>            
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