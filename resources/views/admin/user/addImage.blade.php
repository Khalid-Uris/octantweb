<div class="form-group">
    <div class="image-input image-input-outline" id="kt_image_1">
        <div class="image-input-wrapper" style="background-image: url(assets/media/users/100_1.jpg)"></div>

        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change"
            data-toggle="tooltip" title="" data-original-title="Change avatar">
            <i class="fa fa-pen icon-sm text-muted"></i>

            <input type="file" name="image" value="{{ old('image') }}" accept=".png, .jpg, .jpeg" />
            <input type="hidden" name="profile_avatar_remove" value="{{ old('image') }}" />

        </label>


        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel"
            data-toggle="tooltip" title="Cancel avatar">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>

    </div>

</div>
@error('image')
    <span class="text text-danger">{{ $message }}</span>
@enderror
