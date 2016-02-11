<div class="form-group">
    <label for="name1" class="control-label col-sm-2">Name1:</label>
    <div class="col-sm-10">
        <input type="text" id="name1" class="form-control" placeholder="Name" name="name1" value="{{ Auth::admin()->get()->name }}" required>
    </div>
</div>
<div class="form-group">
    <label for="name2" class="control-label col-sm-2">Name:</label>
    <div class="col-sm-10">
        <input type="text" id="name2" class="form-control" placeholder="Name" name="name2" value="{{ Auth::admin()->get()->name }}" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Email1: </label>
    <div class="col-sm-10">
        <input type="email1" id="email1" class="form-control" placeholder="Email ID" name="email1" value="{{ Auth::admin()->get()->email }}" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Email2: </label>
    <div class="col-sm-10">
        <input type="email2" id="email2" class="form-control" placeholder="Email ID" name="email2" value="{{ Auth::admin()->get()->email }}" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Contact1: </label>
    <div class="col-sm-10">
        <input type="number" id="contact1" class="form-control" placeholder="Contact Number" name="contact1" value="{{ Auth::admin()->get()->contact }}" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Contact2: </label>
    <div class="col-sm-10">
        <input type="number" id="contact2" class="form-control" placeholder="Contact Number" name="contact2" value="{{ Auth::admin()->get()->contact }}" required>
    </div>
</div>
<input type="hidden" id="id" value="">
<input type="hidden" id="row" value="">