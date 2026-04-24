<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/projets.css">
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">


</head>

<body>

  <button onclick="window.location.href='index.html'" class="bouton-retour">
    <span class="fleche-retour" aria-hidden="true">
      <svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M28 12H4M4 12L12 4M4 12L12 20" stroke="#444" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </span>
    Retour à l'accueil
  </button>
<br></br>
<br></br>


  <h1>Photomontage</h1>
  <h3> Clique sur mes projets pour les voir en grand !</h3>

  <div class="gallery">

    <?php
    $dossier_images = __DIR__ . "/../proj";

    // Vérifier si le dossier existe
    if (is_dir($dossier_images)) {
      $images = opendir($dossier_images);
      $compteur = 0;

      echo "<div class='php-gallery'>";

      while (($FILE = readdir($images)) !== false) {
        // Filtrer les fichiers valides
        if (
          $FILE != "." &&
          $FILE != ".." &&
          $FILE != "Thumbs.db" &&
          preg_match('/\.(jpg|jpeg|png|gif)$/i', $FILE)
        ) {
          // Nom sans extension pour le titre
          $nom_projet = pathinfo($FILE, PATHINFO_FILENAME);

          echo "<div class='projet-item'>";
          echo "<div class='polaroid'>";
          echo "<a href='../proj/$FILE' onclick='openLightbox(\"../proj/$FILE\", \"$nom_projet\", \"Photoshop\"); return false;'>";
          echo "<img src='../proj/$FILE' alt='$nom_projet' loading='lazy' />";
          echo "</a>";
          echo "<div class='projet-title'>$nom_projet</div>";
          echo "</div>";
          echo "</div>";

          $compteur++;
        }
      }

      echo "</div>";
      closedir($images);

      if ($compteur == 0) {
        echo "<p>Aucune image trouvée dans le dossier proj/</p>";
      } else {
      }
    } else {
      echo "<p>Erreur : Le dossier 'proj' n'existe pas.</p>";
    }
    ?>
  </div>

  <!-- Lightbox moderne avec image à gauche et infos à droite -->
  <div id="simple-lightbox" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.92); z-index:9999; justify-content:center; align-items:center; padding: 20px;">

    <!-- Conteneur principal de la modal -->
    <div style="display:flex; max-width:1200px; width:100%; max-height:90vh; background:transparent; border-radius:0; overflow:visible; box-shadow:none; gap:0;">

      <!-- Image à gauche (70% de largeur) - SANS FOND -->
      <div style="flex: 0 0 70%; background:transparent; display:flex; align-items:center; justify-content:flex-end; padding:0;">
        <img id="lightbox-img" style="max-width:100%; max-height:90vh; object-fit:contain; border-radius:0; box-shadow:none;">
      </div>

      <!-- Panneau infos à droite (30% de largeur) - CARRÉ AVEC FOND BLANC -->
      <div class="lightbox-panel" style="flex: 0 0 30%; padding:40px 30px; overflow-y:auto; background:#ffffff; display:flex; flex-direction:column; gap:25px; border-radius:0 20px 20px 0; box-shadow: 0 20px 60px rgba(0,0,0,0.5); text-align:left; position:relative;">
        <!-- Bouton fermer dans le coin du carré blanc, bien positionné et aligné à droite -->
    <button class="close-lightbox-btn" onclick="closeLightbox()" aria-label="Fermer la fenêtre" style="top:auto; bottom:18px; right:18px;">&times;</button>

        <!-- Titre du projet -->
        <div style="width:100%;">
          <h2 id="lightbox-title" style="margin:0; font-family:'Portmanteau',serif; font-size:28px; color:#2a2a2a; line-height:1.3; text-align:left;">Titre</h2>
        </div>

        <!-- Tags logiciels -->
        <div id="lightbox-tags" style="display:flex; flex-wrap:wrap; gap:8px; margin-top:10px; width:100%; justify-content:flex-start;">
          <!-- Les tags seront insérés ici dynamiquement -->
        </div>

        <!-- Séparateur -->
        <div style="width:100%; height:1px; background:#e0e0e0;"></div>

        <!-- Description -->
        <div style="width:100%;">
          <h3 style="font-family:'Fredericka the Great',cursive; font-size:16px; color:#666; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px; text-align:left;">Description</h3>
          <p id="lightbox-desc" style="margin:0; font-size:15px; line-height:1.7; color:#555; font-family:ui-rounded,system-ui; text-align:left;">Description du projet...</p>
        </div>

        <!-- Informations techniques (optionnel) -->
        <div id="lightbox-infos" style="background:#f5f5f5; padding:15px; border-radius:10px; font-size:13px; color:#666; width:100%; text-align:left;">
          <!-- Infos techniques seront insérées ici -->
        </div>

      </div>
    </div>
  </div>

  <script>
    // Base de données des projets avec leurs informations détaillées
    const projetsData = {
      // Exemple de structure pour vos projets - À PERSONNALISER
      'nomduprojet': {
        logiciels: ['Photoshop', 'Illustrator'],
        description: 'Description détaillée de votre projet photomontage. Expliquez le concept, la technique utilisée, et l\'inspiration.',
        annee: '2024'
      },
      'cyb3rheaven': {
        logiciels: ['Photoshop', 'Illustrator'],
        description: 'Création d\'affiche publicitaire pour une marque de bière fictive futuriste : Cyb3r Heaven.',
        annee: '2024'
      },
      'lifeisstrange': {
        logiciels: ['Jeu vidéo', 'Photoshop'],
        description: 'Ce photomontage est un projet que j\'ai réalisé à l\'UPEC de Sénart-Fontainebleau. Le thème était libre, mais devait inclure des techniques vues en classe',
        annee: '2024'
      },
      'thelastofus2': {
        logiciels: ['Jeu vidéo', 'Photoshop', 'Photomontage'],
        description: 'J\'ai créé ce photomontage durant ma mobilité au Canada en cours de Créativité au Cégep de Jonquière. Les consignes étaient de réaliser un photomontage avec des images libres de droit,avec des techniques précises vues en classe (colorimétrie, principes de design, lois proximité et similarité, courbes et autres)',
        annee: '2026'
      },
      'finalfantasyviiremake': {
        logiciels: ['Photoshop', 'Jeu vidéo'],
        description: 'J\'ai créé cette affiche durant ma mobilité au Canada en cours de Créativité au Cégep de Jonquière. Les consignes étaient de réaliser une un photomontage en y incluant des techniques précises vues en classe. J\'ai choisi le thème jeu vidéo avec final fantasy 7 remake, un de mes jeux préférés de la licence.',
        annee: '2026'
      },
      'devilmaycry5': {
        logiciels: ['Jeu vidéo', 'Photoshop'],
        description: 'Concept d\'affiche pour le jeu Devil May Cry 5.',
        annee: '2026'
      },
      'bloom&shine': {
        logiciels: ['Photoshop'],
        description: 'Projet de double exposure et tests de brushes',
        annee: '2026'
      },
      'theshadowscene': {
        logiciels: ['Photoshop', 'Illustrator'],
        description: 'J\'ai créé cette scène durant ma mobilité au Canada en cours de Créativité au Cégep de Jonquière. Les consignes étaient de réaliser une scène clé originale de film fictif avec des images libres de droit, en y incluant des techniques précises vues en classe.',
        annee: '2026'
      },
      'theshadow': {
        logiciels: ['Photoshop'],
        description: 'Affiche de film fictif : The Shadow. Synopsis : Elias Simons, homme d\'affaires pragmatique, est accusé d\'un meurtre qu\'il jure ne pas avoir commis. Les caméras de surveillance révèlent l\'impossible : son ombre s\'est détachée de lui et perpétue le crime. Pour prouver son innocence, Elias doit affronter et éliminer sa propre part de ténèbres dans un duel entre deux mondes parallèles. J\'ai créé cette affiche en utilisant des techniques de photomontage avec des images libres de droit, en renforçant l\'atmosphère sombre et mystérieuse avec une colorimétrie chaude et des effets de lumière. J\y ai ajouté beaucoup de détails (empreinte digitale, revolver, glace brisée.) Retravail complet des lumières et corrections à l\'aide de brushes et pinceaux manuels pour sublimer les détails. Inspirations : Skyfall, Tenet et Edmond.',
        annee: '2026'
      },

      // Ajoutez vos autres projets ici avec le même format
    };

    // Couleurs pour les différents logiciels (votre DA)
    const couleursTags = {
      'Photoshop': '#7A9BB8',      // Bleu Adobe
      'Illustrator': '#C8956B',    // Orange Adobe
      'InDesign': '#B8857A',       // Rose Adobe
      'Premiere Pro': '#9B7B9A',   // Violet Adobe
      'After Effects': '#9B7B9A',  // Violet Adobe
      'Lightroom': '#7A9BB8',      // Bleu Adobe
      'Jeu vidéo': '#4A9B8E'       // Vert turquoise
    };

    function openLightbox(imgSrc, title, defaultDesc) {
      console.log('Ouverture lightbox:', title);

      // Afficher l'image et le titre
      document.getElementById('lightbox-img').src = imgSrc;
      document.getElementById('lightbox-title').textContent = title;

      // Récupérer les données du projet (si elles existent)
      const projetInfo = projetsData[title.toLowerCase().replace(/\s+/g, '')] || {};

      // Afficher la description
      const description = projetInfo.description || defaultDesc || 'Projet de design graphique réalisé avec passion et créativité.';
      document.getElementById('lightbox-desc').textContent = description;

      // Créer les tags logiciels + année
      const tagsContainer = document.getElementById('lightbox-tags');
      tagsContainer.innerHTML = '';

      const logiciels = projetInfo.logiciels || ['Photoshop'];
      logiciels.forEach(logiciel => {
        const tag = document.createElement('span');
        tag.textContent = logiciel;
        tag.style.cssText = `
          display: inline-flex;
          align-items: center;
          padding: 6px 14px;
          background: ${couleursTags[logiciel] || '#7A9BB8'};
          color: white;
          border-radius: 20px;
          font-size: 12px;
          font-weight: 600;
          font-family: 'Fredericka the Great', cursive;
          letter-spacing: 0.5px;
          box-shadow: 0 2px 8px rgba(0,0,0,0.15);
          transition: transform 0.2s ease;
        `;
        tag.onmouseover = () => tag.style.transform = 'translateY(-2px)';
        tag.onmouseout = () => tag.style.transform = 'translateY(0)';
        tagsContainer.appendChild(tag);
      });

      // Ajouter le tag année si disponible
      if (projetInfo.annee) {
        const tagAnnee = document.createElement('span');
        tagAnnee.textContent = projetInfo.annee;
        tagAnnee.style.cssText = `
          display: inline-flex;
          align-items: center;
          padding: 6px 14px;
          background: #2a2a2a;
          color: white;
          border-radius: 20px;
          font-size: 12px;
          font-weight: 600;
          font-family: 'Fredericka the Great', cursive;
          letter-spacing: 0.5px;
          box-shadow: 0 2px 8px rgba(0,0,0,0.15);
          transition: transform 0.2s ease;
        `;
        tagAnnee.onmouseover = () => tagAnnee.style.transform = 'translateY(-2px)';
        tagAnnee.onmouseout = () => tagAnnee.style.transform = 'translateY(0)';
        tagsContainer.appendChild(tagAnnee);
      }

      // Cacher les infos techniques (non utilisées)
      const infosContainer = document.getElementById('lightbox-infos');
      infosContainer.style.display = 'none';

      document.getElementById('simple-lightbox').style.display = 'flex';

      // Ajuster la largeur du carré blanc en responsive pour qu'il corresponde à l'image
      function ajusterLargeurCarre() {
        if (window.innerWidth <= 800) {
          const img = document.getElementById('lightbox-img');
          const infoPanel = document.querySelector('#simple-lightbox > div > div:last-child');
          const modalContainer = document.querySelector('#simple-lightbox > div');

          // Attendre un court instant pour que l'image soit bien affichée
          setTimeout(() => {
            const imgWidth = img.offsetWidth;
            const imgHeight = img.offsetHeight;

            // Détecter si l'image est en portrait (hauteur > largeur)
            if (imgHeight > imgWidth) {
              modalContainer.classList.add('portrait-mode');
            } else {
              modalContainer.classList.remove('portrait-mode');
            }

            if (imgWidth > 0) {
              infoPanel.style.width = imgWidth + 'px';
              infoPanel.style.maxWidth = imgWidth + 'px';
            }
          }, 100);
        }
      }

      const img = document.getElementById('lightbox-img');
      img.onload = ajusterLargeurCarre;

      // Si l'image est déjà chargée
      if (img.complete) {
        ajusterLargeurCarre();
      }
    }

    function closeLightbox() {
      document.getElementById('simple-lightbox').style.display = 'none';
    }

    // Fermer avec Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeLightbox();
      }
    });

    // Fermer en cliquant sur le fond
    document.getElementById('simple-lightbox').addEventListener('click', function(e) {
      if (e.target === this) {
        closeLightbox();
      }
    });

    // Script pour contrôle ergonomique du MacBook (pause/reprise de l'animation)
    (function() {
      const macbook = document.querySelector('.macbook');
      const viewport = document.querySelector('.viewport');
      let isHovering = false;

      if (macbook && viewport) {
        // Détecter le hover sur le MacBook
        macbook.addEventListener('mouseenter', function() {
          isHovering = true;
        });

        macbook.addEventListener('mouseleave', function() {
          isHovering = false;
          // Reset quand on quitte
          viewport.style.transition = 'background-position 1s ease';
          viewport.style.backgroundPosition = '0 0';
          setTimeout(() => {
            viewport.style.transition = 'background-position 5s ease-in-out';
          }, 1000);
        });

        // Contrôle manuel au survol pour ralentir/accélérer
        viewport.addEventListener('mousemove', function(e) {
          if (!isHovering) return;

          const rect = viewport.getBoundingClientRect();
          const mouseY = e.clientY - rect.top;
          const viewportHeight = rect.height;
          const relativePosition = mouseY / viewportHeight;

          // Ajuster la vitesse selon la position de la souris
          if (relativePosition < 0.3) {
            // En haut : ralentir l'animation
            viewport.style.transition = 'background-position 8s ease-in-out';
          } else if (relativePosition > 0.7) {
            // En bas : accélérer l'animation
            viewport.style.transition = 'background-position 3s ease-in-out';
          } else {
            // Milieu : vitesse normale
            viewport.style.transition = 'background-position 5s ease-in-out';
          }
        });
      }
    })();
  </script>


<!-- SECTION INDESIGN PDF -->
<h1 style="margin-top:64px;">Brochures</h1>
<h3>Explore mes livrets et projets PDF !</h3>
<div class="gallery indesign-gallery">
  <!-- Affichage des deux projets JPG -->
  <div class='php-gallery'>
    <div class='indesign-row' style='display:flex; gap:32px; justify-content:center; margin-bottom:32px;'>
      <div class='projet-item'>
        <div class='polaroid'>
          <a href='#' onclick='openIndesignJpgLightbox(0); return false;'>
            <img src='indesign/indesignjpg/article-scénart.jpg' alt='Article Scénart' style='width:180px; height:240px; object-fit:contain; background:transparent; border:2px solid #fff; box-shadow:0 0 32px #000;' />
          </a>
          <div class='projet-title'>Article Scénart</div>
        </div>
      </div>
      <div class='projet-item'>
        <div class='polaroid'>
          <a href='#' onclick='openIndesignJpgLightbox(1); return false;'>
            <img src='indesign/indesignjpg/pamphlet-cegep.jpg' alt='Pamphlet Cégep' style='width:180px; height:240px; object-fit:contain; background:transparent; border:2px solid #fff; box-shadow:0 0 32px #000;' />
          </a>
          <div class='projet-title'>Pamphlet Cégep</div>
        </div>
      </div>
      <div class='projet-item'>
        <div class='polaroid'>
          <a href='#' onclick='openIndesignJpgLightbox(2); return false;'>
            <img src='indesign/indesignjpg/hanabira-hotel/hanabira-hotel_pages-to-jpg-0001.jpg' alt='Hanabira Hotel' style='width:180px; height:240px; object-fit:contain; background:transparent; border:2px solid #fff; box-shadow:0 0 32px #000;' />
          </a>
          <div class='projet-title'>Hanabira Hotel</div>
        </div>
      </div>
    </div>
    <div class='indesign-row' style='display:flex; gap:32px; justify-content:center; margin-bottom:32px;'>
      <div class='projet-item'>
        <div class='polaroid'>
          <a href='#' onclick='openIndesignJpgLightbox(3); return false;'>
            <img src='indesign/indesignjpg/laufey-livret/laufey-livret_page-0001.jpg' alt='Laufey Livret' style='width:180px; height:240px; object-fit:contain; background:transparent; border:2px solid #fff; box-shadow:0 0 32px #000;' />
          </a>
          <div class='projet-title'>Laufey Livret</div>
        </div>
      </div>
      <div class='projet-item'>
        <div class='polaroid'>
          <a href='#' onclick='openIndesignJpgLightbox(4); return false;'>
            <img src='indesign/indesignjpg/ski-resort/ski-resort_page-0001.jpg' alt='Ski Resort' style='width:180px; height:240px; object-fit:contain; background:transparent; border:2px solid #fff; box-shadow:0 0 32px #000;' />
          </a>
          <div class='projet-title'>Ski Resort</div>
        </div>
      </div>
      <div class='projet-item'>
        <div class='polaroid'>
          <a href='#' onclick='openIndesignJpgLightbox(5); return false;'>
            <img src='indesign/indesignjpg/typographie/typographie-japonaise_page-0001.jpg' alt='Typographie Japonaise' style='width:180px; height:240px; object-fit:contain; background:transparent; border:2px solid #fff; box-shadow:0 0 32px #000;' />
          </a>
          <div class='projet-title'>Typographie Japonaise</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Lightbox Indesign JPG -->
<div id="indesignjpg-lightbox" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.92); z-index:9999; justify-content:center; align-items:center; padding: 20px;">
  <div style="display:flex; max-width:1200px; width:100%; max-height:90vh; background:transparent; border-radius:0; overflow:visible; box-shadow:none; gap:0;">
    <!-- Image à gauche -->
  <div id="indesignjpg-img-bg" style="flex: 0 0 70%; background:#f7f3e8; display:flex; align-items:center; justify-content:center; padding:0; position:relative; border-radius:28px 0 0 28px; box-shadow:0 8px 32px rgba(0,0,0,0.22);">
      <img id="indesignjpg-img" src="" alt="Page projet" style="max-width:80%; max-height:80vh; object-fit:contain; background:transparent; border-radius:12px; border:2px solid #fff; box-shadow:0 0 32px #000;" />
  <div id="indesignjpg-page-count" style="position:absolute; bottom:24px; right:24px; background:#222; color:#fff; padding:8px 18px; border-radius:8px; font-size:1.1em; font-family:'Indie Flower',cursive;">1/1</div>
    </div>
    <!-- Infos à droite -->
    <div class="lightbox-panel" style="flex: 0 0 30%; padding:40px 30px; overflow-y:auto; background:#ffffff; display:flex; flex-direction:column; gap:25px; border-radius:0 20px 20px 0; box-shadow: 0 20px 60px rgba(0,0,0,0.5); text-align:left; position:relative;">
      <button class="close-lightbox-btn" onclick="closeIndesignJpgLightbox()" aria-label="Fermer la fenêtre" style="top:auto; bottom:18px; right:18px;">&times;</button>
      <div style="width:100%;">
        <h2 id="indesignjpg-title" style="margin:0; font-family:'Portmanteau',serif; font-size:28px; color:#2a2a2a; line-height:1.3; text-align:left;">Titre</h2>
      </div>
      <div id="indesignjpg-tags" style="display:flex; flex-wrap:wrap; gap:8px; margin-top:10px; width:100%; justify-content:flex-start;"></div>
      <div style="width:100%; height:1px; background:#e0e0e0;"></div>
      <div style="width:100%;">
        <h3 style="font-family:'Fredericka the Great',cursive; font-size:16px; color:#666; margin:0 0 10px 0; text-transform:uppercase; letter-spacing:1px; text-align:left;">Description</h3>
        <p id="indesignjpg-desc" style="margin:0; font-size:15px; line-height:1.7; color:#555; font-family:ui-rounded,system-ui; text-align:left;">Description du projet...</p>
      </div>
      <div id="indesignjpg-infos" style="background:#f5f5f5; padding:15px; border-radius:10px; font-size:13px; color:#666; width:100%; text-align:left;"></div>
    </div>
  </div>
</div>

<script>
// Lightbox pour les projets JPG (une seule page)
const indesignJpgData = [
  {
    title: 'Article Scénart',
    desc: "Livret d'article scénographique, mise en page créative et typographie expressive.",
    tags: ['InDesign'],
    pages: ['indesign/indesignjpg/article-scénart.jpg'],
    infos: '1 page'
  },
  {
    title: 'Pamphlet Cégep',
    desc: "Pamphlet institutionnel, structure claire et DA professionnelle.",
    tags: ['InDesign'],
    pages: ['indesign/indesignjpg/pamphlet-cegep.jpg'],
    infos: '1 page'
  },
  {
    title: 'Hanabira Hotel',
    desc: "Projet de branding hôtelier, design élégant et direction artistique raffinée.",
    tags: ['InDesign'],
    pages: [
      'indesign/indesignjpg/hanabira-hotel/hanabira-hotel_pages-to-jpg-0001.jpg',
      'indesign/indesignjpg/hanabira-hotel/hanabira-hotel_pages-to-jpg-0002.jpg',
      'indesign/indesignjpg/hanabira-hotel/hanabira-hotel_pages-to-jpg-0003.jpg',
      'indesign/indesignjpg/hanabira-hotel/hanabira-hotel_pages-to-jpg-0004.jpg',
      'indesign/indesignjpg/hanabira-hotel/hanabira-hotel_pages-to-jpg-0005.jpg',
      'indesign/indesignjpg/hanabira-hotel/hanabira-hotel_pages-to-jpg-0006.jpg',
      'indesign/indesignjpg/hanabira-hotel/hanabira-hotel_pages-to-jpg-0007.jpg',
      'indesign/indesignjpg/hanabira-hotel/hanabira-hotel_pages-to-jpg-0008.jpg'
    ],
    infos: '8 pages'
  },
  {
    title: 'Laufey Livret',
    desc: "Livret musical illustré, harmonie visuelle et composition moderne.",
    tags: ['InDesign'],
    pages: [
      'indesign/indesignjpg/laufey-livret/laufey-livret_page-0001.jpg',
      'indesign/indesignjpg/laufey-livret/laufey-livret_page-0002.jpg',
      'indesign/indesignjpg/laufey-livret/laufey-livret_page-0003.jpg',
      'indesign/indesignjpg/laufey-livret/laufey-livret_page-0004.jpg',
      'indesign/indesignjpg/laufey-livret/laufey-livret_page-0005.jpg',
      'indesign/indesignjpg/laufey-livret/laufey-livret_page-0006.jpg',
      'indesign/indesignjpg/laufey-livret/laufey-livret_page-0007.jpg',
      'indesign/indesignjpg/laufey-livret/laufey-livret_page-0008.jpg'
    ],
    infos: '8 pages'
  },
  {
    title: 'Ski Resort',
    desc: "Livret touristique, ambiance hivernale et design immersif.",
    tags: ['InDesign'],
    pages: [
      'indesign/indesignjpg/ski-resort/ski-resort_page-0001.jpg',
      'indesign/indesignjpg/ski-resort/ski-resort_page-0002.jpg'
    ],
    infos: '2 pages'
  },
  {
    title: 'Typographie Japonaise',
    desc: "Étude typographique, inspiration japonaise et DA minimaliste.",
    tags: ['InDesign'],
    pages: [
      'indesign/indesignjpg/typographie/typographie-japonaise_page-0001.jpg',
      'indesign/indesignjpg/typographie/typographie-japonaise_page-0002.jpg'
    ],
    infos: '2 pages'
  }
];

let currentIndesignJpg = 0;
let currentIndesignJpgPage = 1;

function openIndesignJpgLightbox(idx) {
  currentIndesignJpg = idx;
  currentIndesignJpgPage = 1;
  const proj = indesignJpgData[idx];
  document.getElementById('indesignjpg-lightbox').style.display = 'flex';
  updateIndesignJpgLightbox();
}

function updateIndesignJpgLightbox() {
  const proj = indesignJpgData[currentIndesignJpg];
  document.getElementById('indesignjpg-img').src = proj.pages[currentIndesignJpgPage-1];
  document.getElementById('indesignjpg-img').style.background = 'transparent';
  document.getElementById('indesignjpg-img').style.border = '2px solid #fff';
  document.getElementById('indesignjpg-img').style.boxShadow = '0 0 32px #000';
  document.getElementById('indesignjpg-title').textContent = proj.title;
  document.getElementById('indesignjpg-desc').textContent = proj.desc;
  let tagsHtml = '';
  proj.tags.forEach(tag => {
    tagsHtml += `<span style='border:2px solid #222; border-radius:6px; padding:6px 18px; font-size:1em; font-family:inherit; background:#fff; color:#222; margin-right:8px;'>${tag}</span>`;
  });
  document.getElementById('indesignjpg-tags').innerHTML = tagsHtml;
  document.getElementById('indesignjpg-infos').innerHTML = `<b>Nombre de pages :</b> ${proj.pages.length}`;
  document.getElementById('indesignjpg-page-count').textContent = `${currentIndesignJpgPage}/${proj.pages.length}`;
  // Flèches
  if (proj.pages.length > 1) {
    if (!document.getElementById('indesignjpg-prev')) {
      const prevBtn = document.createElement('button');
      prevBtn.id = 'indesignjpg-prev';
      prevBtn.innerHTML = '&#x2039;';
      prevBtn.style.position = 'absolute';
      prevBtn.style.left = '0';
      prevBtn.style.top = '50%';
      prevBtn.style.transform = 'translateY(-50%)';
  prevBtn.style.background = '#111';
  prevBtn.style.border = '2px solid #fff';
  prevBtn.style.borderRadius = '8px';
  prevBtn.style.width = '48px';
  prevBtn.style.height = '48px';
  prevBtn.style.fontSize = '2em';
  prevBtn.style.color = '#fff';
  prevBtn.style.cursor = 'pointer';
  prevBtn.style.zIndex = '2';
  prevBtn.onmouseover = function() { prevBtn.style.background = '#fff'; prevBtn.style.color = '#111'; };
  prevBtn.onmouseout = function() { prevBtn.style.background = '#111'; prevBtn.style.color = '#fff'; };
      prevBtn.onclick = function() {
        if (currentIndesignJpgPage > 1) {
          currentIndesignJpgPage--;
          updateIndesignJpgLightbox();
        }
      };
      document.getElementById('indesignjpg-img').parentNode.appendChild(prevBtn);
    }
    if (!document.getElementById('indesignjpg-next')) {
      const nextBtn = document.createElement('button');
      nextBtn.id = 'indesignjpg-next';
      nextBtn.innerHTML = '&#x203A;';
      nextBtn.style.position = 'absolute';
      nextBtn.style.right = '0';
      nextBtn.style.top = '50%';
      nextBtn.style.transform = 'translateY(-50%)';
  nextBtn.style.background = '#111';
  nextBtn.style.border = '2px solid #fff';
  nextBtn.style.borderRadius = '8px';
  nextBtn.style.width = '48px';
  nextBtn.style.height = '48px';
  nextBtn.style.fontSize = '2em';
  nextBtn.style.color = '#fff';
  nextBtn.style.cursor = 'pointer';
  nextBtn.style.zIndex = '2';
  nextBtn.onmouseover = function() { nextBtn.style.background = '#fff'; nextBtn.style.color = '#111'; };
  nextBtn.onmouseout = function() { nextBtn.style.background = '#111'; nextBtn.style.color = '#fff'; };
      nextBtn.onclick = function() {
        if (currentIndesignJpgPage < proj.pages.length) {
          currentIndesignJpgPage++;
          updateIndesignJpgLightbox();
        }
      };
      document.getElementById('indesignjpg-img').parentNode.appendChild(nextBtn);
    }
    document.getElementById('indesignjpg-prev').disabled = (currentIndesignJpgPage <= 1);
    document.getElementById('indesignjpg-next').disabled = (currentIndesignJpgPage >= proj.pages.length);
  } else {
    if (document.getElementById('indesignjpg-prev')) document.getElementById('indesignjpg-prev').remove();
    if (document.getElementById('indesignjpg-next')) document.getElementById('indesignjpg-next').remove();
  }
}

function closeIndesignJpgLightbox() {
  document.getElementById('indesignjpg-lightbox').style.display = 'none';
}
</script>

  <h1>Maquettes et interfaces web</h1>
  <br></br>
  <br></br>
  <br></br>
  <br></br>

  <p class="macbook-instruction">Clique pour changer de projet</p>

  <div class="macbook">
    <div class="screen">
      <div class="viewport" id="macbook-viewport">
        <img src="culturemk.jpg" alt="Culture MK" class="viewport-image active">
        <img src="orya-bijouterie.jpg" alt="Orya Bijouterie" class="viewport-image">
      </div>
    </div>
    <div class="base"></div>
    <div class="notch"></div>
  </div>

  <script>
    // Changement d'image au clic sur le MacBook
    (function() {
      const viewport = document.getElementById('macbook-viewport');
      const images = viewport.querySelectorAll('.viewport-image');
      let currentIndex = 0;

      viewport.addEventListener('click', function() {
        // Masquer l'image actuelle
        images[currentIndex].classList.remove('active');

        // Passer à l'image suivante
        currentIndex = (currentIndex + 1) % images.length;

        // Afficher la nouvelle image
        images[currentIndex].classList.add('active');
      });
    })();
  </script>

<h1>Projets audiovisuels</h1>


<div class="postit-court-metrage">
  <div class="masking-tape"></div>
  <h2>J'ai créé la mélodie principale d'un court-métrage intitulé "Egerie" au piano, modifiée ensuite sur ordinateur.</h2>
  <p>Ce projet a eu la chance d'être diffusé au cinéma.<br>
    <span class="extrait-highlight">En voici un extrait audio.</span>
  </p>
  <div class="audio-extrait-container">
    <audio controls>
      <source src="thalassophobie.mp3" type="audio/mpeg">
      Your browser does not support the audio element.
    </audio>
  </div>
</div>

  <div style="max-width: 560px; margin: 20px auto;">
    <iframe width="100%" height="315"
      src="https://www.youtube.com/embed/PpYqhH08iBQ?start=75&end=133&autoplay=0&rel=0"
      title="Timelapse"
      frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
      allowfullscreen>
    </iframe>
  </div>
  <br></br>
  <br></br>
  <br></br>
  <div class="clapet-action-container">
    <div class="clapet-action-top" style="margin-bottom: 0;">
      <div class="clapet-action-bar"></div>
      <div class="clapet-action-bar"></div>
      <div class="clapet-action-bar"></div>
    </div>
    <div class="clapet-action-body" style="box-shadow: 0 6px 32px rgba(42,42,42,0.13); border: none;">
      <h2>J'ai aussi eu le rôle de l'actrice principale d'un court-métrage indépendant avec le même réalisateur : "Reine de la Pleine Lune"</h2>
      <div class="clapet-action-video">
        <iframe width="100%" height="315"
          src="https://www.youtube.com/embed/9k3cBXcK0yw?start=400&autoplay=0&rel=0"
          title="Timelapse Reine de la Pleine Lune"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      </div>
    </div>
  </div>

 <br></br>


</body>

</html>
