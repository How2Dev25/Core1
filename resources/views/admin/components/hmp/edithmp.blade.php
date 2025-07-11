<dialog id="edit_modal_{{$hmp->promoID}}" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Edit {{$hmp->hotelpromoname}}</h3>
      <form action="/edithmp/{{$hmp->promoID}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if($hmp->hotelpromophoto)
            <div class="mt-2 mb-2">
                <img id="editphoto" class="rounded-md w-full max-h-max" src="{{asset($hmp->hotelpromophoto)}}" alt="">
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Pick an image (Optional)</legend>
                  <input id="editdropzone-file" name="hotelpromophoto" type="file" class="file-input" />
                  <label class="label">Max size 2MB</label>
                </fieldset>
            </div>

            <div class="mt-2 mb-2">
              <fieldset class="fieldset">
                <legend class="fieldset-legend">Promotion Name</legend>
                <input value="{{$hmp->hotelpromoname}}" type="text" name="hotelpromoname" class="input" placeholder="Type here" />
              </fieldset>
            </div>
            @endif

            <div class="mt-2 mb-2">
              <fieldset class="fieldset">
                <legend class="fieldset-legend">Promotion Tag Line</legend>
                <input value="{{$hmp->hotelpromotag}}" name="hotelpromotag" type="text" class="input" placeholder="Type here" />
                <p class="label">#ChristmasEvent2025</p>
              </fieldset>
            </div>

            <div class="mt-2 mb-2">
            <fieldset class="fieldset">
              <legend class="fieldset-legend">Promo Date Range</legend>
              <input value="{{$hmp->hotelpromodaterange}}" name="hotelpromodaterange" type="text" class="input" placeholder="Type here" />
              <p class="label">June 12 2025 - June 16 2025</p>
            </fieldset>
          </div>


          <div class="mt-2 mb-2">
          <fieldset class="fieldset">
            <legend class="fieldset-legend">Promo Description</legend>
            <textarea name="hotelpromodescription" class="textarea h-24" placeholder="Check in at the Hotel this December 2025">{{$hmp->hotelpromodescription}}</textarea>
          </fieldset>
          </div>

          <div class="mt-2 mb-2">
            <fieldset class="fieldset">
              <legend class="fieldset-legend">Promo Status</legend>
              <select name="hotelpromostatus" class="select">
                <option value="Active" {{ $hmp->hotelpromostatus == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Expired" {{ $hmp->hotelpromostatus == 'Expired' ? 'selected' : '' }}>Expired</option>
            </select>
              
            </fieldset>
          </div>

          <button class="bg-blue-700 cursor-pointer hover:bg-blue-800 p-2 font-bold text-white rounded-md shadow-md text-sm" type="submit" value="submit" onclick="console.log('Clicked Submit')">Submit</button>

      </form>
    </div>
    <form method="dialog" class="modal-backdrop">
       
      <button>close</button>
    </form>
  </dialog>