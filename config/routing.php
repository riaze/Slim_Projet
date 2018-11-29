<?php

// Routage
use App\Controller\Admin\ProjectAdminController;
use App\Controller\ProjectController;

// Groupe de routes : les projets
$app->group('/projet', function () {
    // Le détail
    $this->get('/{index:\d+}', ProjectController::class . ':show')->setName('front_project_show');
    // La liste
    $this->get('/liste', ProjectController::class . ':liste')->setName('front_project_index');
});

// Groupe de routes : administration des projets
$app->group('/admin/projet', function() {
    $this->get('/', ProjectAdminController::class . ':liste')->setName('back_projet_index');
    $this->get('/{index:\d+}', ProjectAdminController::class . ':show')->setName('back_projet_show');
    $this->get('/addprojet', ProjectAdminController::class . ':addprojets')->setName('back_Add_Projets');
    $this->post('/addprojet', ProjectAdminController::class . ':createCheck')->setName('back_Add_checkProjets');
});










