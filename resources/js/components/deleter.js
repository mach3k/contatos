    var deleter = {

        linkSelector          : "a[data-delete]",
        modalTitle            : "Você tem certeza?",
        modalMessage          : "Você não vai poder restaurar este registro!",
        modalConfirmButtonText: "Sim, Exclua isso!",
        laravelToken          : null,
        url                   : "/",

        init: function() {
            $(this.linkSelector).on('click', {self:this}, this.handleClick);
        },

        handleClick: function(event) {
            event.preventDefault();

            var self = event.data.self;
            var link = $(this);

            self.modalTitle             = link.data('title') || self.modalTitle;
            self.modalMessage           = link.data('message') || self.modalMessage;
            self.modalConfirmButtonText = link.data('button-text') || self.modalConfirmButtonText;
            self.url                    = link.attr('href');
            self.laravelToken           = $("meta[name=token]").attr('content');

            self.confirmDelete();

        },

        confirmDelete: function() {
            swal({
                    title             : this.modalTitle,
                    text              : this.modalMessage,
                    type              : "warning",
                    showCancelButton  : true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText : this.modalConfirmButtonText,
                    closeOnConfirm    : true
                }).then(function(isConfirm) {
				  if (isConfirm) {
					this.makeDeleteRequest();
				  }
				}.bind(this));
        },

        makeDeleteRequest: function() {

            var form =
                $('<form>', {
                    'method': 'POST',
                    'action': this.url
                });

            var token =
                $('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': this.laravelToken
                });

            var hiddenInput =
                $('<input>', {
                    'name': '_method',
                    'type': 'hidden',
                    'value': 'DELETE'
                });

            return form.append(token, hiddenInput).appendTo('body').submit();
        }
    };

    deleter.init();
