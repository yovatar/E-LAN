<?php

/**
 * Condition view for terms of services
 * @return void
 */
function viewCondition()
{
    $title = "Condition d'utilisateur";

    ob_start();
?>
<div class="px-5 py-4 text-center bg-white filter drop-shadow-lg "><br>
    <a class="text-4xl hover:text-blue-500">Conditions d’utilisation</a><br>
    <p class="text-2xl">merci de réspecter</p><br><br>
    <ul class="list-decimal list-outside md:list-inside ">

        <li>E-LAN décline, dans toute la mesure permise par la loi, toute responsabilité envers vous et toute autre
            personne en ce qui concerne le contenu de nos Sites et les services fournis par l’intermédiaire de nos
            Sites, en particulier par rapport à d’éventuels dommages-intérêts, pertes (de production, de revenus, de
            bénéfices) ou autres qui pourraient en découler, directement ou indirectement, même en cas de négligence, de
            faute ou de tort de E-LAN.</li>
        <li>Les pages de nos Sites peuvent inclure des liens vers des pages Internet externes. Nous ne sommes pas
            responsables de ces contenus externes, et nous n’en garantissons en aucune manière l’actualité, l’exactitude
            ou la complétude. Les politiques de confidentialité et les conditions d’utilisation de ces tiers peuvent
            être différentes des nôtres. Nous incluons ces liens uniquement parce que nous pensons qu’ils peuvent vous
            être utiles, sans toutefois que cela engage notre responsabilité.<br></li>

        <li>Nous n’offrons aucune garantie de compatibilité de nos Sites avec votre équipement matériel ou logiciel.
            <br>
        </li>

        <li>Le contenu publié sur nos Sites ne constitue pas une invitation ou une recommandation d’acheter des produits
            et services ou de conclure d’autres transactions. Les exceptions sont mises en évidence. <br></li>

        <li>Le fonctionnement de nos Sites peut être soumis à des interruptions (volontaires ou involontaires) ou des
            perturbations ; nous ne garantissons donc pas une disponibilité continue de nos Sites. <br></li>

        <li>Nous pouvons modifier, suspendre ou terminer n’importe quel Service à tout moment. Nous nous réservons le
            droit de restreindre, suspendre ou clôturer votre compte si nous estimons possible que vous ne respectiez
            pas ce Contrat ou la loi, ou que votre utilisation des Services est abusive <br></li>

        <li>Le contenu et les œuvres créées par E-LAN sur nos Sites sont soumis au droit d’auteur suisse. E-LAN conserve
            l’intégralité des droits de propriété intellectuelle liés à nos Sites et aux informations qu’ils
            contiennent, quelle qu’en soit leur forme ou leur format. La reproduction, l’édition, la distribution et
            tout type d’utilisation en dehors des limites de la loi sur le droit d’auteur nécessitent notre consentement
            écrit. <br></li>

        <li>Vous vous engagez à utiliser nos Sites en toute bonne foi et uniquement pour les buts légitimes pour
            lesquels ceux-ci sont mis à disposition. <br></li>

        <li>Lorsque vous vous inscrivez sur notre site, vous disposez d’un compte personnel. Vous êtes responsable de
            toute utilisation de votre compte, à moins que vous ne l’effaciez ou que vous nous signaliez une utilisation
            abusive. Vous acceptez de choisir un mot de passe sécurisé, d’en protéger la sécurité et la confidentialité
        </li>

        <li>En accédant à nos Sites, ou en vous inscrivant à nos services, vous acceptez de conclure un contrat qui vous
            engage légalement avec E-LAN, ainsi que toutes les personnes physiques ou morales que vous représentez </li>

    </ul>
</div>

<?php
    $content = ob_get_clean();

    require_once "view/template.php";
    viewTemplate($title, $content);
}