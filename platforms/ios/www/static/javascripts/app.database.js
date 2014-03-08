App.database = {

	shortname: 'bashrety', 
	version: '1.1', 
	displayname: 'bashrety', 
	maxsize: 10*1024*1024,
	
	db: {},

	open: function() {
		//console.log("Trying to open database.");
		this.db = openDatabase(this.shortname, "", this.displayname, this.maxsize);
		this.createTables();
	},

	createTables: function() {
		//console.log("Trying to create table.");
		// User table (id = Local, user_id = API ID)
		var user_definition = "\
			CREATE TABLE IF NOT EXISTS `user`(\
				`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, \
				`user_name` TEXT NULL, \
				`email` TEXT NOT NULL, \
				`age` INTEGER NULL, \
				`gender` TEXT NULL, \
				`language` TEXT NULL, \
				`current_user` INTEGER NOT NULL DEFAULT 0 \
			);";

		var article_sync_definition = "\
			CREATE TABLE IF NOT EXISTS `article_sync` ( \
				`servertime` INTEGER NOT NULL PRIMARY KEY \
			);";
			
		this.db.transaction(
			function(transaction) {
				transaction.executeSql(user_definition, [], App.database.nullDataHandler, App.database.errorHandler);
				transaction.executeSql(article_sync_definition, [], App.database.nullDataHandler, App.database.errorHandler);
			}
		);
	},

	addUser: function(d) {
		// console.log("Adding logged in user to local DB.");
		// console.log(d);
		d.current_user = (d.current_user != undefined && d.current_user) ? 1 : 0;

		if (d.id != undefined) { 
			var data_array = [d.id, d.userName, d.email, d.age, d.gender, d.language, d.current_user];
			var query = "INSERT OR IGNORE INTO `user` (`id`,`user_name`,`email`, `age`, `gender`, `language`, `current_user`) \
					VALUES (?, ?, ?, ?, ?, ?, ?);";
		} else {
			var data_array = [d.id, d.userName, d.email, d.age, d.gender, d.language, d.current_user];
			var query = "INSERT INTO `user` (`id`,`user_name`,`email`, `age`, `gender`, `language`, `current_user`) \
					VALUES (?, ?, ?, ?, ?, ?, ?);";
		}		
		this.db.transaction(
			function(transaction) {
				transaction.executeSql(query, data_array, App.database.handleInsertedUser, App.database.errorHandler);
			}
		);
	},

	getCurrentUser: function(ref) {
		//Query DB for logged in user.
		var query = "SELECT * FROM `user` WHERE `current_user` = 1";
		//console.log(query);
		this.db.transaction(
			function(transaction) {
				transaction.executeSql(query, [], ref.handleGetUserDB, App.database.errorHandler);
			}
		);
	},

	handleInsertedUser: function(transaction, results) {
		// Do something.
	},

	

	destroyDB: function(reason, ref) {
		var command;
		switch (reason) {
			case "version":
			case "logout":
				command = "DROP TABLE";
				break;
			//case "logout":
			default:
				command = "DELETE FROM";
				break;
		}
		this.db.transaction(
			function(transaction) {
				transaction.executeSql(command + " `user`", [], App.database.nullDataHandler, App.database.errorHandler);
			}
		);
	},

	errorHandler: function(transaction, error) {
		// error.message is a human-readable string.
		// error.code is a numeric error code
		console.log('Oops.  Error was '+error.message+' (Code '+error.code+')');

		// Handle errors here
		var we_think_this_error_is_fatal = true;
		if (we_think_this_error_is_fatal) return true;
		return false;
	},

	nullDataHandler: function(transaction, results) {
		// Do nothing.
		//console.log(results);
		//Lungo.Notification.hide();
	},

	// When passed as the error handler, this silently causes a transaction to fail.
	killTransaction: function(transaction, error) {
		return true;
	}
}
