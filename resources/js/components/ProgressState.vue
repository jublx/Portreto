<template>
  <div class="container page">
    <h1><span>Avancement</span> du projet</h1>
    <p>Cette page présente sous forme d'un tableau l'état d'avancement du projet. Ce tableau est mis à jour au fur et à mesure des modifications.
      vous pouvez également consulter les détails du projet sur le site Wordpress associé (voir section &laquo; À propos &raquo;).
    </p>
    <div class="w-75" style="margin:auto;">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col"><span>Date</span></th>
          <th scope="col"><span>Nouveauté</span></th>
        </tr>
      </thead>
      <tbody>        
        <tr v-for="changement in changements" :key="changement.content">
          <td>{{changement.date}}</td>
          <td>{{changement.content}}</td>
        </tr>
      </tbody>
    </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      changements: [
        {
          date: '26-12-2020',
          content: 'Affichage d\'un formulaire "ajouter un contact" sur le tableau de bord.'
        },
        {
          date: '26-12-2020',
          content: 'Affichage des différents réseaux sociaux des utilisateurs.'
        },
        {
          date: '15-12-2020',
          content: "Création du \"code ami\" unique pour chaque utilisateur, on le retrouve sur le tableau de bord lorsqu'on est connecté."
        },
        {
          date: '11-12-2020',
          content: "Ajout de la modification des informations d'un utilisateur à partir du Tableau de bord de celui-ci."
        },
        {
          date: '12-11-2020',
          content: "Création d'une page de profile accessible si l'utilisateur est connecté."
        },
        {
          date: '10-11-2020',
          content: "Mise en ligne d'une première version du site."
        },
        {
          date: '07-11-2020',
          content: "Création de la base de donnée avec Mariadb."
        },
        {
          date: '07-11-2020',
          content: 'Mise à jour du Wordpress.'
        },
        {
          date: '06-11-2020',
          content: "Ajout d'un formulaire d'inscription et d'un formulaire de connexion sur la page d'accueil."
        },
        {
          date: '17-10-2020',
          content: 'Créations des pages "Avancement", "À propos" et "Contact", accessible à partir du footer.'
        },
        {
          date: '16-10-2020',
          content: "Création de la page d'accueil du site avec un premier design."
        },
        {
          date: '01-10-2020',
          content: 'Création du premier Wordpress sous le nom de "Visit me".'
        }
      ]            
    }
  }
}
</script>

<style scoped>
div {
  text-align: center;
}

p {
  margin-top: 40px;
}
</style>