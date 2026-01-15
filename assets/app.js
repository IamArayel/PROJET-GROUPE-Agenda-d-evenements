import './stimulus_bootstrap.js';
import './styles/app.css';

import $ from 'jquery';

$(document).ready(function () {

    $(document).on('click', '.js-categorie', function (e) {
        e.preventDefault();

        const categorieId = $(this).data('id');

        $('#events-container').html(`
            <div class="col-span-full flex justify-center items-center py-12">
                <span class="loading loading-spinner loading-lg text-primary"></span>
            </div>
        `);

        $.ajax({
            url: '/evenements/categorie/' + categorieId,
            method: 'GET',
            success: function (html) {
                $('#events-container').html(html);
            },
            error: function () {
                $('#events-container').html(`
                    <div class="col-span-full">
                        <div role="alert" class="alert alert-error">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>Erreur lors du chargement des événements.</span>
                        </div>
                    </div>
                `);
            }
        });
    });

});

console.log('JS catégories chargé ✅');
