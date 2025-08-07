<dialog id="createhmp" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Add Promotional Marketing</h3>
      <form action="/createhmp" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="mt-2 mb-2">
                <img id="photo" class="rounded-md w-full max-h-max" src="{{asset('images/defaults/default.jpg')}}" alt="">
                <fieldset class="fieldset">
                  <legend class="fieldset-legend">Pick an image (Optional)</legend>
                  <input required id="dropzone-file" name="hotelpromophoto" type="file" class="file-input" />
                  <label class="label">Max size 2MB</label>
                </fieldset>
            </div>

            <div class="mt-2 mb-2">
              <fieldset class="fieldset">
                <legend class="fieldset-legend">Promotion Name</legend>
                <input type="text" name="hotelpromoname" class="input" placeholder="Type here" />
              </fieldset>
            </div>

            <div class="mt-2 mb-2">
              <fieldset class="fieldset">
                <legend class="fieldset-legend">Promotion Tag Line</legend>
                <input name="hotelpromotag" type="text" class="input" placeholder="Type here" />
                <p class="label">#ChristmasEvent2025</p>
              </fieldset>
            </div>

            <div class="mt-2 mb-2">
            <fieldset class="fieldset">
              <legend class="fieldset-legend">Promo Date Range</legend>
              <input name="hotelpromodaterange" type="text" class="input" placeholder="Type here" />
              <p class="label">June 12 2025 - June 16 2025</p>
            </fieldset>
          </div>


          <div class="mt-2 mb-2">
          <fieldset class="fieldset">
            <legend class="fieldset-legend">Promo Description</legend>
            <textarea name="hotelpromodescription" class="textarea h-24" placeholder="Check in at the Hotel this December 2025"></textarea>
          </fieldset>
          </div>

          <div class="mt-2 mb-2">
            <fieldset class="fieldset">
              <legend class="fieldset-legend">Promo Status</legend>
              <select name="hotelpromostatus" class="select">
                <option value="Active" selected>Active</option>
                <option value="Expired">Expired</option>
              </select>
              
            </fieldset>
          </div>

          <button class="btn btn-primary" type="submit" value="submit" onclick="console.log('Clicked Submit')">Submit</button>

      </form>
    </div>
    <form method="dialog" class="modal-backdrop">
       
      <button>close</button>
    </form>
  </dialog>