/**
 * Submete os dados do formulário via POST.
 *
 * @param {string}  formId    Id do formulário a ser submetido
 * @param {boolean} onSuccess Se true, recarrega a página
 **/
function onSubmitForm(formId, onSuccess)
{
    $(formId).submit(function(e)
    {
        e.preventDefault();

        const form = $(formId);
        const button = form.find('button[type="submit"]');
        const messageBox = form.find('div.toast-message');

        button.prop('disabled', true);

        return $.post(
            this.action,
            form.serialize(),
            function(res)
            {
                if (res.status === 'success') {
                    showSuccessMessage(res.message, messageBox);
                    form[0].reset();

                    if (onSuccess !== undefined) {
                        window.location.reload();
                    }
                }
            }
        )

        .fail(function(error)
        {
            showErrorMessage(error.responseJSON.message, messageBox);
        })

        .always(function()
        {
            button.prop('disabled', false);
        });
    });
}

/**
 * showSuccessMessage.
 *
 * @param {string} message
 * @param {div}    messageBox
 */
function showSuccessMessage(message, messageBox)
{
    showMessage('success', message, messageBox);
}

/**
 * showErrorMessage.
 *
 * @param {string} message
 * @param {div}    messageBox
 */
function showErrorMessage(message, messageBox)
{
    showMessage('danger', message, messageBox);
}

/**
 * Exibe uma mensagem do tipo toast.
 *
 * @param {string} type       Tipo da mensagem: danger, success, info, warning
 * @param {string} message    Conteúdo da mensagem
 * @param {div}    messageBox Bloco div que exibirá a mensagem
 **/
function showMessage(type, message, messageBox)
{
    if (message !== undefined && message !== '') {
        messageBox
            .append('<div class="alert alert-' + type + '" role="alert">' + message + '</div><br>')
            .find('.alert:last')
            .fadeIn('fast')
            .delay(4000)
            .fadeOut(900);
    }
}
