@extends('backend.layouts.app')

@section('content')

@php
$business = App\Models\GeneralSetting::first();
@endphp

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col">
			<h1 class="h3">{{ translate('Website Header') }}</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Header Setting') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
	                    <label class="col-md-3 col-from-label">{{ translate('Header Logo') }}</label>
						<div class="col-md-8">
		                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
		                        </div>
		                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="header_logo">
		                        <input type="hidden" name="header_logo" class="selected-files" value="{{ get_setting('header_logo') }}">
		                    </div>
		                    <div class="file-preview"></div>
						</div>
	                </div>
                    <div class="form-group row">
						<label class="col-md-3 col-from-label">{{translate('Show Language Switcher?')}}</label>
						<div class="col-md-8">
							<label class="aiz-switch aiz-switch-success mb-0">
								<input type="hidden" name="types[]" value="show_language_switcher">
								<input type="checkbox" name="show_language_switcher" @if( get_setting('show_language_switcher') == 'on') checked @endif>
								<span></span>
							</label>
						</div>
					</div>
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Show Currency Switcher?')}}</label>
						<div class="col-md-8">
							<label class="aiz-switch aiz-switch-success mb-0">
								<input type="hidden" name="types[]" value="show_currency_switcher">
								<input type="checkbox" name="show_currency_switcher" @if( get_setting('show_currency_switcher') == 'on') checked @endif>
								<span></span>
							</label>
						</div>
					</div>
	                <div class="form-group row pb-2">
						<label class="col-md-3 col-from-label">{{translate('Enable stikcy header?')}}</label>
						<div class="col-md-8">
							<label class="aiz-switch aiz-switch-success mb-0">
								<input type="hidden" name="types[]" value="header_stikcy">
								<input type="checkbox" name="header_stikcy" @if( get_setting('header_stikcy') == 'on') checked @endif>
								<span></span>
							</label>
						</div>
					</div>

					<div class="border-top pt-3 ">
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Header Message')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<input type="text" class="form-control" name="header_msg" value="{{ $business->header_msg }}">
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Phone Number')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<input type="text" class="form-control" name="phone" value="{{ $business->phone }}">
								</div>
							</div>
						</div>
					</div>
                
					<div class="border-top pt-3 ">
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Promo Line')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<textarea name="promo_line" rows="4" class="form-control">{{ $business->promo_line }}</textarea>
								</div>
							</div>
						</div>
                        
                        <div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Promo Background Option')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<select name="promo_option" class="form-control">
									    <option value="image" @if($business->promo_option == 'image') selected @endif>Background Image</option>
									    <option value="color" @if($business->promo_option == 'color') selected @endif>Background Color</option>
									</select>
								</div>
							</div>
						</div>
                        
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Background color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<input type="color" name="promo_bgcolor" value="{{ $business->promo_bgcolor }}">
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Font color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<input type="color" name="promo_fontcolor" value="{{ $business->promo_fontcolor }}">
								</div>
							</div>
						</div> 

						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{ translate('Promo Image') }}</label>
							<div class="col-md-8">
								<div class=" input-group " data-toggle="aizuploader" data-type="image">
									<div class="input-group-prepend">
										<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
									</div>
									<div class="form-control file-amount">{{ translate('Choose File') }}</div>
									<input type="hidden" name="promo_bgimg" class="selected-files" value="">
								</div>
								<div class="file-preview"></div>
							</div>
						</div>

						
					</div>

					<div class="border-top pt-3">
						<label class="">{{translate('Header Nav Menu')}}</label>
						<div class="header-nav-menu">
							<input type="hidden" name="types[]" value="header_menu_labels">
							<input type="hidden" name="types[]" value="header_menu_links">
							@if (get_setting('header_menu_labels') != null)
								@foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-4">
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="{{ $value }}">
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<input type="text" class="form-control" placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://" name="header_menu_links[]" value="{{ json_decode(App\BusinessSetting::where('type', 'header_menu_links')->first()->value, true)[$key] }}">
											</div>
										</div>
										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='<div class="row gutters-5">
								<div class="col-4">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://" name="header_menu_links[]">
									</div>
								</div>
								<div class="col-auto">
									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
										<i class="las la-times"></i>
									</button>
								</div>
							</div>'
							data-target=".header-nav-menu">
							{{ translate('Add New') }}
						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
