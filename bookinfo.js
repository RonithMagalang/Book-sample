export default function bookinfo(selector) {
  $(selector).empty();
  $(selector).append(`
<div class="container">
<div class="col">
<div class="form-group">
            <label for=""></label>
            <input type="text"
              class="form-control" name="" id="bookcode" aria-describedby="helpId" placeholder="Book code">
               <small id="helpId" class="form-text text-muted"></small>
 </div>

 <div class="form-group">
            <label for=""></label>
            <input type="text"
              class="form-control" name="" id="bookname" aria-describedby="helpId" placeholder="Book Name">     
             <small id="helpId" class="form-text text-muted"></small>
 </div>
 <div class="form-group">
            <label for=""></label>
            <input type="text"
              class="form-control" name="" id="author" aria-describedby="helpId" placeholder="Author">
               <small id="helpId" class="form-text text-muted"></small>       
 </div>

          <button type="submit" id="save" class="btn btn-primary mt-4">save</button>
        
</div>
</div>
</div>


	`);
}
