App.api = function() {
	
	var config = {
		url: "http://api.etched.io/api/",
		token: "1234567890",
		controller: "",
		action: "",
		method: "POST",
		callback: ""
	}

	return {
		curr_image: 0,

		loginUser: function(ref) {
			console.log("Running loginUser");
			if (ref.validateLogin() === true) {
				console.log("Validates. " + config.url + "login" + $$.serializeParameters(ref.details, "?"));
				$$.get(config.url + "login", ref.details, function(data) {
					ref.handleLogin(data);
				}, "json");
			} else {
				console.log("User doesn't validate.");
			}
		},

		addUser: function(ref) {
			console.log("Running addUser");
			if (ref.validate("new") === true) {
				console.log("Validates. " + config.url + "user  " + JSON.stringify(ref.details));
				$$.post(config.url + "user", JSON.stringify(ref.details), function(data) {
					ref.handleAdd(data);
				}, "json");
			} else {
				console.log("User doesn't validate.");
			}
		},

		updateUser: function(ref) {
			console.log("Running updateUser");
			if (ref.validate("update") === true) {
				console.log("Validates. " + config.url + "user  " + JSON.stringify(ref.details));
				$$.put(config.url + "user", JSON.stringify(ref.details), function(data) {
					ref.handleUpdateUser(data);
				}, "json");
			} else {
				console.log("User doesn't validate.");
			}
		},

		addMoment: function(ref) {
			console.log("Running addMoment");
			this.uploadImages(ref);
		},

		handleAddImages: function(ref) {
			if (ref.validate() === true) {
				console.log("Validates. " + config.url + "moment  " + JSON.stringify(ref.details));
				$$.post(config.url + "moment", JSON.stringify(ref.details), function(data) {
					// ref.handleAdd(data);
					console.log("Success");
				}, "json");
			} else {
				console.log("Moment doesn't validate.");
			}
		},

		getMoments: function(ref) {
			console.log("Running getMoments");
			console.log(config.url + "moment" + $$.serializeParameters(ref.details, "?"));
			$$.get(config.url + "moment", ref.details, function(data) {
				ref.handleGet(data);
			}, "json");
		},

		getCollaborators: function(ref) {
			console.log("Running getCollaborators");
			console.log(config.url + "collaborator" + $$.serializeParameters(ref.details, "?"));
			$$.get(config.url + "collaborator", ref.details, function(data) {
				ref.handleGetCollaborators(data);
			}, "json");	
		},

		uploadImages: function(ref) {
			//Upload images.
			var _this = this;
			var _ref = ref;
			ref.details.apiimages = [];
			var s3upload = s3upload != null ? s3upload : new S3Upload({
				file_dom_selector: 'moment-form-upload-files',
				s3_sign_put_url: 'http://api.etched.io/api/fileupload',

				onProgress: function(percent, message) { // Use this for live upload progress bars
					console.log('Upload progress: ', percent, message);
				},
				onFinishS3Put: function(public_url) { // Get the URL of the uploaded file
					console.log('Upload finished: ', public_url);
					var url_parts = public_url.split("/");
					_ref.details.apiimages.push({url_hash: url_parts[url_parts.length - 1]});
					_this.curr_image++;
					if (_this.curr_image == rediscovr.currentmoment.num_images) {
						// Save moment.
						_this.handleAddImages(_ref);
					}
				},
				onError: function(status) {
					console.log('Upload error: ', status);
					Lungo.Notification.hide();
				}
			});

		}
	}
}
