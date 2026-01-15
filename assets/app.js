import './stimulus_bootstrap.js';
import './styles/app.css';

import $ from 'jquery';

$(document).ready(function () {

    $(document).on('click', '.js-categorie', function (e) {
        e.preventDefault();

        const categorieId = $(this).data('id');

        $('#events-body').html(`
            <tr>
                <td colspan="4" class="text-center">
                    Chargement...
                </td>
            </tr>
        `);

        $.ajax({
            url: '/evenement/categorie/' + categorieId,
            method: 'GET',
            success: function (html) {
                $('#events-body').html(html);
            },
            error: function () {
                $('#events-body').html(`
                    <tr>
                        <td colspan="4" class="text-danger text-center">
                            Erreur de chargement
                        </td>
                    </tr>
                `);
            }
        });
    });

});

console.log('JS catégories chargé ✅');
