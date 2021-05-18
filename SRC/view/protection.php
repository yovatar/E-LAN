<?php

/**
 * lost view for unknown routes
 * @return void
 */
function viewProtect()
{
    $title = "Protection des Données";

    ob_start();
?>
<div class="px-5 py-4 text-center bg-white filter drop-shadow-lg "><br>
    <a class="text-4xl hover:text-blue-500">Politique de protection</a><br>
    <p class="text-2xl"> Nous allons </p><br><br>
    <ul class="list-decimal list-outside md:list-inside ">
        <li> vos données se trouve dans nos datacenters basés exclusivement en Suisse, et ne jamais transférer vos
            données en dehors de nos propres infrastructures.<br></li>

        <li> Mettre en oeuvre des standards de sécurité élevés, et maintenir des processus d'amélioration continue afin
            de vous fournir un haut niveau de sécurité dans le cadre de nos services.<br></li>

        <li> Vous notifier dans les meilleurs délais en cas de violation de vos données.<br></li>

        <li> Être transparent lorsque nous faisons appel à des sous-traitants qui pourraient traiter vos données.<br>
        </li>

        <li> Maintenir et développer nos mesures de sécurité physique afin d'empêcher l'accès aux infrastructures sur
            lesquelles sont stockées vos données par des personnes non autorisées.<br></li>

        <li> Avoir des systèmes d'isolation physique et/ou logique (en fonction des services) afin d'isoler les
            hébergements des clients entre eux, et réaliser une fois par année des tests d'intrusion dans le but de
            s'assurer de l'étanchéité des données entre les clients.<br></li>

        <li> Être exemplaire en termes de réactivité dans les mises à jour de sécurité sur les systèmes dont nous avons
            la gestion.<br></li>
    </ul>
</div>

<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}