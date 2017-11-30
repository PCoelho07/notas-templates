$(function() {
    /******************************************************************
     *                           Masks                                *
     *****************************************************************/
    $('.date-field').mask(
        '00/00/0000',
        {placeholder: "__/__/____"}
    );

    $('.money-field').mask(
        '000.000.000.000.000,00',
        {reverse: true}
    );

    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11
            ? '(00) 00000-0000'
            : '(00) 0000-00009'
        ;
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(
                SPMaskBehavior.apply({}, arguments),
                options
            );
        }
    };
    $('.phone-field').mask(SPMaskBehavior, spOptions);

    var cpfCnpj = function (val) {
        return val.length > 14
            ? '00.000.000/0000-00'
            : '000.000.000-009'
        ;
    },
    optionsDocument = {
        onKeyPress: function(val, e, field, options) {
            field.mask(
                cpfCnpj(val),
                options
            );
        }
    };
    $('.cpfcnpj-field').mask(cpfCnpj, optionsDocument);

    /****************************************************************
    *                     Summernote editor                         *
    ****************************************************************/
    $('#property-description').summernote({
        lang: 'pt-BR',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
        height: 220
    });

    /**********************************************************
    *              College Table CRUD controls                *
    **********************************************************/
    $('#is_free').on('change', function () {
        if ($(this).prop('checked') == true) {
            $('#declared_value').prop('checked', false);
        }
    });

    $('#declared_value').on('change', function () {
        if ($(this).prop('checked') == true) {
            $('#is_free').prop('checked', false);
        }
    });

    /**********************************************************
    *                   Costs CRUD controls                   *
    **********************************************************/
    $('.period-select').on('change', function() {
        var period_id = $(this).val(),
            url = '/costs-form/collegeTableByPeriod/' + period_id;

        $.get(url, function(data) {
            $('.college-table-select')
                .empty()
                .append(
                    $('<option>')
                        .text('')
                        .attr('value', '')
                )
            ;

            $.each(data, function(i, tableItem) {
                $('.college-table-select')
                    .append(
                        $('<option>')
                            .text(tableItem.item + ' ' + tableItem.description)
                            .attr('value', tableItem.id)
                            .attr('data-declared-value', tableItem.declared_value)
                            .attr('data-is-free', tableItem.is_free)
                    )
                ;
            });
        });
    });

    /**********************************************************
    *                  Deed Types controls                    *
    **********************************************************/
    $('#charge-mode').on('change', function() {
        $('.deed-charge').addClass('hidden');
        $('.minimum-value').removeAttr('disabled');
        $('.percentage, .fraction')
            .children()
            .attr('disabled', true)
            .removeAttr('required')
        ;

        var mode = $(this).val();

        if (mode == 1) {
            $('.minimum-value')
                .attr('disabled', true)
                .prop('checked', false)
            ;

            return false;
        }

        if (mode == 2 || mode == 3) {
            $('.percentage')
                .removeClass('hidden')
                .children()
                .removeAttr('disabled')
                .attr('required', true)
            ;

            return false;
        }

        $('.fraction')
            .removeClass('hidden')
            .children()
            .removeAttr('disabled')
            .attr('required', true)
        ;

        return false;
    });
    $('#charge-mode').change();

    $('.college-table-select').on('change', function() {
        var isFree = $('option:selected', this).data('is-free') == 1,
            hasDeclaredValue = $('option:selected', this).data('declared-value') == 1;

        if (true == isFree) {
            $('#range')
                .attr('disabled', true)
                .val('')
            ;

            $('.money-field, .declared-value')
                .removeAttr('required')
                .attr('disabled', true)
            ;

            return false;
        }

        if (false == hasDeclaredValue) {
            $('#range')
                .attr('disabled', true)
                .val('')
            ;

            $('.money-field')
                .removeAttr('disabled')
            ;

            $('.declared-value')
                .attr('disabled', true)
            ;

            return false;
        }

        $('.declared-value, #range, .money-field').removeAttr('disabled');
        $('.money-field').attr('required', true);
        $('#charge-mode').trigger('change');

        return false;
    });
    $('.college-table-select').change();

    /**********************************************************
    *                  Properties form controls               *
    **********************************************************/
    $('#transaction-value-flag').on('change', function () {
        if ($(this).prop('checked') == false) {
            $('#transaction-value').removeAttr('disabled');
            return false;
        }

        $('#transaction-value')
            .attr('disabled', true)
            .val(' ')
        ;

        return false;
    });

    $('#base-value-flag').on('change', function () {
        if ($(this).prop('checked') == false) {
            $('#base-value').removeAttr('disabled');

            return false;
        }

        $('#base-value')
            .attr('disabled', true)
            .val(' ')
        ;

        return false;
    });

    $('#localization').on('change', function () {
        var local = $(this).val();

        $('#municipal_registration, #federal_registration')
            .attr('disabled', true)
            .val('')
        ;

        if (local == 1 || local == '1') { // Urban
            $('#municipal_registration')
                .removeAttr('disabled')
            ;

            return false;
        }

        $('#federal_registration')
            .removeAttr('disabled')
        ;

        return false;
    });

    $('#property-type').on('change', function () {
        var type = $(this).val();

        if (type == 89) {
            $('#type-desc')
                .removeAttr('disabled')
            ;

            return false;
        }

        $('#type-desc')
            .attr('disabled', true)
            .val('')
        ;

        return false;
    });

    $('#area-info').on('change', function () {
        var info = $(this).val();

        if (info == 1 || info == '1') {
            $('#area-number')
                .removeAttr('disabled')
            ;

            return false;
        }

        $('#area-number')
            .attr('disabled', true)
            .val('')
        ;

        return false;
    });

    /**********************************************************
    *                  Clients form controls                  *
    **********************************************************/
    $('#status_cpfcnpj').on('change', function () {
        var status = $(this).val();

        if (status == 1) {
            $('#cpfcnpj')
                .removeAttr('disabled');

            return false;
        }

        $('#cpfcnpj')
            .attr('disabled', true)
            .val('')
        ;

        return false;
    });

    var enableChildren = function (className, children) {
        $(className)
            .children(children)
            .removeAttr('disabled')
        ;

        return false;
    };

    var disableChildren = function (className, children) {
        $(className)
            .children(children)
            .attr('disabled', true)
            .removeAttr('required')
            .val('')
        ;

        return false;
    };

    $('#document_type').on('change', function () {
        var type = $(this).val();

        disableChildren('.rg', 'input, select');

        if (type == 1) {
            return enableChildren('.rg', 'input, select');
        }
    });
    $('#document_type').change();

    $('#civil-status').on('change', function () {
        var status = $(this).val();

        if (status == 2) {
            enableChildren(
                '.marriage-info',
                'input, select'
            );

            return enableChildren(
                '.divorce-info',
                'input'
            );
        }

        if (status == 6 || status == 7) {
            return enableChildren(
                '.divorce-info',
                'input'
            );
        }

        return disableChildren(
            '.marriage-info, .divorce-info',
            'input, select'
        );
    });
    $('#civil-status').change();

    $('#minor_children').on('change', function() {
        $('#children_responsible').removeAttr('disabled');

        if ($(this).val() <= 0) {
            $('#children_responsible')
                .attr('disabled', true)
                .val('')
            ;
        }
    });
    $('#minor_children').change();

    /**********************************************************
    *              Tab Expenses form controls                 *
    **********************************************************/
    $('#expense-type').on('change', function() {
        const option     = $('option:selected', this),
              percentage = option.data('percentage'),
              isGeneral  = option.data('general') == 1;

        if (isGeneral) {
            $('#value')
                .removeAttr('disabled')
                .removeAttr('readonly')
            ;

            return ;
        }

        if (percentage > 0) {
            $('#base-value')
                .removeAttr('disabled')
                .removeAttr('readonly')
            ;

            return ;
        }
    });
    $('#expense-type').change();

    $('#quantity, #base-value').on('change', function() {
        const option     = $('option:selected', '#expense-type'),
              value      = option.data('value'),
              percentage = option.data('percentage'),
              isGeneral  = option.data('general') == 1,
              quantity   = $('#quantity').val();

        if (isGeneral) {
            return ;
        }

        var numberFormat = function(num) {
            return num
                .toFixed(2)
                .replace('.', ',')
                .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
            ;
        };

        if (percentage > 0) {
            var base_value = $('#base-value').val();
            base_value = base_value
                .replace(".", "")
                .replace(",", ".")
            ;

            var result = (base_value * quantity * percentage) / 100;
            $('#value').val(numberFormat(result));

            return ;
        }

        var result = value * quantity;
        $('#value').val(numberFormat(result));
    });

    /**********************************************************
    *                  Protocol/Costs tab                     *
    **********************************************************/
    $('.deed-type-select').on('change', function() {
        if (false == $('option:selected', this).data('declare-value')) {
            $('#declared-value')
                .attr('disabled', true)
                .removeAttr('required')
            ;

            return false;
        }

        $('#declared-value')
            .removeAttr('disabled')
            .attr('required', true)
        ;

        return false;
    });

    /**********************************************************
    *                       ViaCep                            *
    **********************************************************/
    function fillAddressFields(content = '') {
        $('.street, .neighborhood, .city, .uf, .ibge').val(content);
    }

    $(".zipcode").blur(function() {
        var zipcode = $(this).val().replace(/\D/g, '');

        if (zipcode != "") {
            var validZipcode = /^[0-9]{8}$/;

            if (validZipcode.test(zipcode)) {
                fillAddressFields('...');

                $.getJSON("//viacep.com.br/ws/"+ zipcode +"/json/?callback=?", function(dados) {
                    if (! ("erro" in dados)) {
                        $(".street").val(dados.logradouro);
                        $(".neighborhood").val(dados.bairro);
                        $(".city").val(dados.localidade);
                        $(".uf option[value="+dados.uf+"]").prop('selected', true);
                        $(".ibge").val(dados.ibge);
                        $('.building_number').val('').focus();
                    } else {
                        fillAddressFields();
                        alert("CEP não encontrado.");
                    }
                });
            } else {
                fillAddressFields();
                alert("Formato de CEP inválido.");
            }
        } else {
            fillAddressFields();
        }
    });

    /**********************************************************
    *                 Expense Types controls                  *
    **********************************************************/
    $('#general-expense').on('change', function() {
         if ($(this).prop('checked') == true) {
            $('.money-field').val('0,00').attr('disabled', true);
            return false;
        }

        $('.money-field').removeAttr('disabled');
    })
    $('#general-expense').change();

    /**********************************************************
    *       Focus on the first control in all forms           *
    **********************************************************/
    $('.form-control')
        .first()
        .focus()
    ;

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    /**********************************************************
    *            Protocol/Transfer tab controls               *
    **********************************************************/
    $('.disable_printed').on('change', function() {
        var form = $(this).parent('form');

        form.submit();
    });

    /**********************************************************
    *             Protocol/General tab controls               *
    **********************************************************/
    $('#deed-nature').on('change', function () {
        var has_litigation_nature = $('option:selected', $(this)).data('has-litigation-nature');

        $('.litigation-fields').hide().attr('disabled', true);

        if (has_litigation_nature == true) {
            $('.litigation-fields').show().removeAttr('disabled');
        }
    });
    $('#deed-nature').change();

    $('#scribe_id').on('change', function() {
        var id = $(this).val(),
            isSubscriber = $('option:selected', this)
                .data('subscriber') == 1
            ;

        if (isSubscriber) {
            $('#subscriber_id').val(id);
        }
    });

    /**********************************************************
    *                   Users form controls                   *
    **********************************************************/
    $('.role-checkbox').on('change', function() {
        var roleId    = $(this).data('role-id'),
            isChecked = $(this).prop('checked') == 1;

        // Gestor de protocolos
        if (roleId == 5 && isChecked) {
            $('[data-role-id=2]').prop('checked', isChecked);

            return ;
        }

        if (roleId == 2 && ! isChecked) {
            $('[data-role-id=5]').prop('checked', false);

            return ;
        }

        // Assina atos
        if (roleId == 4 && isChecked) {
            $('[data-role-id=3]').prop('checked', isChecked);

            return ;
        }

        if (roleId == 3 && ! isChecked) {
            $('[data-role-id=4]').prop('checked', false);

            return ;
        }
    });

    $('#cpfcnpj-client, #cpfcnpj-contact').on('change', function() {
        // ajax call to retrieve client info
        var cpfCnpj = $(this).val();

        $("#client-name").val('');
        $("#client-zip-code").val('');
        $("#client-address").val('');
        $("#client-building-number").val('');
        $("#client-complement").val('');
        $("#client-neighborhood").val('');
        $("#client-city").val('');
        $("#client-state").val('');
        $("#client-mobile").val('');
        $("#client-phone").val('');
        $("#client-email").val('');

        $("#client-id").val('');

        // protocols fields
        $("#contact_name").val('');
        $("#contact_zip_code").val('');
        $("#contact_address").val('');
        $("#contact_building_number").val('');
        $("#contact_complement").val('');
        $("#contact_neighborhood").val('');
        $("#contact_city").val('');
        $("#contact_state").val('');
        $("#contact_mobile").val('');
        $("#contact_phone").val('');
        $("#contact_email").val('');

        if (cpfCnpj != '') {
            var endpoint = '/clients/' + cpfCnpj.replace(/[^0-9]/g, '');

            $.get(endpoint, function(client) {
                if (client != "") {
                    $("#client-name").val(client.name);
                    $("#client-zip-code").val(client.zip_code);
                    $("#client-address").val(client.street_name);
                    $("#client-building-number").val(client.building_number);
                    $("#client-complement").val(client.complement);
                    $("#client-neighborhood").val(client.neighborhood);
                    $("#client-city").val(client.city);
                    $("#client-state").val(client.state);
                    $("#client-mobile").val(client.mobile_number);
                    $("#client-phone").val(client.phone_number);
                    $("#client-email").val(client.email);

                    $("#client-id").val(client.id);

                    // protocols fields
                    $("#contact_name").val(client.name);
                    $("#contact_zip_code").val(client.zip_code);
                    $("#contact_address").val(client.street_name);
                    $("#contact_building_number").val(client.building_number);
                    $("#contact_complement").val(client.complement);
                    $("#contact_neighborhood").val(client.neighborhood);
                    $("#contact_city").val(client.city);
                    $("#contact_state option[value=" + client.state + "]").prop('selected', true);
                    $("#contact_mobile").val(client.mobile_number);
                    $("#contact_phone").val(client.phone_number);
                    $("#contact_email").val(client.email);
                } else {
                    alert("Cliente não encontrado.");
                }
            });
        }
    });

    /**********************************************************
     *               Certificates form controls               *
     **********************************************************/
    $('#billing, #certificate-type').on('change', function () {
        $('#deposit-total-value').val('0,00');
        $('#deposit-quantity').val('');
    });

    $('#deposit-quantity').on('change', function() {
        var quantity = $(this).val();
        var deposit  = $('#deposit-total-value');
        var billing  = $('#billing').val();
        var certificateType = $('#certificate-type').val();
        var numberFormat = function(num) {
            return parseFloat(num)
                .toFixed(2)
                .replace('.', ',')
                .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
            ;
        };

        deposit.val('0,00');
        if (quantity <= 0) {
            alert('Quantidade deve ser maior que 0');
            return false;
        }

        if (! billing) {
            alert('Selecione uma modalidade de cobrança para calcular o valor do depósito');
            return false;
        }

        if (! certificateType) {
            alert('Selecione um tipo de certidão para calcular o valor do depósito');
            return false;
        }

        $.get(
            '/certificate-deposit/' + certificateType + '/' + billing + '/' + quantity,
            function(depositValue) {
                if (isNaN(depositValue)) {
                    alert(depositValue);
                    return false;
                }

                $('#deposit-total-value').val(numberFormat(depositValue));
            }
        );

        return false;
    });

    $('#certificate-type').on('change', function() {
        var deliveryDate = $('#delivery-date');

        deliveryDate.val('');

        $.get(
            '/certificate-delivery/' + $(this).val(),
            function(date) {
                if (date != '') {
                    deliveryDate.val(date);
                    return false;
                }

                alert('Houve um problema no cálculo da previsão de entrega... tente novamente.');
            }
        );

        return false;
    });

    /**********************************************************
     *                 Deed Natures form controls             *
     **********************************************************/
    $('#cep-deed').on('change', function () {
        var selected = $(this).find(':selected');

        if (selected.data('has-previous-deeds') == true) {
            $('#has_previous_deeds').attr('disabled', true);
        } else {
            $('#has_previous_deeds').removeAttr('disabled');
        }

        $('.scripture-cep').hide();
        if (selected.text().toLowerCase().indexOf('escritura') > -1) {
            var deed_id = selected.val();
            var url = '/api/central-deeds/' + deed_id + '/scripture-natures';

            $.get(url, function(data) {
                var nature_id = $('#cep-deed').data('scripture-nature-id');
                $('#scripture-nature').empty().append('<option value=""></option>');

                $.each(data, function(i, nature) {
                    var selected = ' selected ';
                    if (nature_id != nature.id) {
                        selected = ' ';
                    }

                    $('#scripture-nature').append([
                        '<option value="', nature.id,
                        '"', selected,
                        'data-has-previous-deeds="',
                        nature.has_previous_deeds,'">',
                        nature.code + ' - ' + nature.description,
                        '</option>',
                    ].join(''));
                });
            });
            $('.scripture-cep').show();
        }
    });

    // Se a central escolhida for cep, exibir a linha com os campos tipo do ato e natureza da escritura
    $('#notarial-central').on('change', function() {
        if ($(this).val() == 1) {
            var deed_id = $(this).data('deed-id');

            $('.cep-fields').show();
            $('.scripture-cep').hide();
            var url = '/api/notarial-centrals/' + $(this).val() + '/deeds';

            $.get(url, function(data) {
                $('#cep-deed').empty().append('<option value=""></option>');

                $.each(data, function(i, deed) {
                    var selected = ' selected ';
                    if (deed_id != deed.id) {
                        selected = ' ';
                    }

                    $('#cep-deed').append([
                        '<option value="', deed.id,
                        '"', selected,
                        'data-has-previous-deeds="',
                        deed.has_previous_deeds,'">',
                        deed.description,
                        '</option>',
                    ].join('')).trigger('change');
                });
            });
        } else {
            $('.cep-fields').hide();
            $('#cep-deed').empty();
        }
    });
    $('#notarial-central').change();

    /**********************************************************
     *            Scripture Natures form controls             *
     **********************************************************/
    $("#central").on('change', function() {
        var url = '/api/notarial-centrals/' + $(this).val() + '/scriptures';
        var deed_id = $(this).data('deed-id');

        $.get(url, function(data) {
            $('#cep-deed').empty()
                          .append('<option value=""></option>');

            $.each(data, function(i, deed) {
                var selected = ' selected ';
                if (deed_id != deed.id) {
                    selected = ' ';
                }

                $('#cep-deed').append([
                    '<option value="', deed.id,
                    '"', selected, '>',
                    deed.description,
                    '</option>',
                ].join('')).trigger('change');
            });
        });
    });
    $('#central').change();
});
