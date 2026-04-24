// ============================================
// 📋 GUIDE : Comment ajouter vos projets
// ============================================
// 
// Copiez ce code dans la section projetsData du fichier projets.php
// et personnalisez-le pour chaque projet !

const projetsData = {
  
  // 🎨 EXEMPLE 1 : Poster avec Photoshop
  'afficheparis': {
    logiciels: ['Photoshop', 'Lightroom'],
    description: 'Affiche promotionnelle pour un événement culturel à Paris. Utilisation de techniques de photomontage pour créer une atmosphère onirique et captivante.',
    date: '2024',
    techniques: ['Photomontage', 'Color grading', 'Masques de fusion', 'Typographie créative']
  },
  
  // 🎨 EXEMPLE 2 : Design avec Illustrator
  'logocafebio': {
    logiciels: ['Illustrator'],
    description: 'Création d\'un logo moderne et épuré pour un café bio. L\'identité visuelle reflète les valeurs écologiques et la simplicité du concept.',
    date: '2023',
    techniques: ['Vectorisation', 'Design d\'identité', 'Palette de couleurs naturelles']
  },
  
  // 🎨 EXEMPLE 3 : Projet complet multi-logiciels
  'campagnepub': {
    logiciels: ['Photoshop', 'Illustrator', 'InDesign'],
    description: 'Campagne publicitaire complète incluant affiches, flyers et brochures. Travail sur la cohérence visuelle et l\'impact marketing.',
    date: '2024',
    techniques: ['Direction artistique', 'Mise en page', 'Print design', 'Retouche photo']
  },
  
  // 🎨 EXEMPLE 4 : Vidéo
  'clipmusical': {
    logiciels: ['Premiere Pro', 'After Effects'],
    description: 'Montage d\'un clip musical avec effets visuels dynamiques. Synchronisation parfaite avec le rythme et création d\'une ambiance immersive.',
    date: '2024',
    techniques: ['Montage vidéo', 'Motion design', 'Color correction', 'Effets visuels']
  },

  // 🎨 EXEMPLE 5 : Photo retouchée
  'portraitartistique': {
    logiciels: ['Photoshop', 'Lightroom'],
    description: 'Série de portraits artistiques avec retouches subtiles. Mise en valeur de l\'émotion et de la personnalité du sujet.',
    date: '2023',
    techniques: ['Retouche beauté', 'Dodge & Burn', 'Color grading cinématique']
  },

  // =====================================
  // 💡 STRUCTURE D'UN PROJET :
  // =====================================
  // 
  // 'nomduprojet': {                          // ⚠️ IMPORTANT : Utilisez le nom EXACT du fichier sans extension et sans espaces
  //   logiciels: ['Nom1', 'Nom2'],            // Liste des logiciels utilisés
  //   description: 'Texte...',                // Description détaillée
  //   date: '2024',                           // Année de réalisation
  //   techniques: ['Tech1', 'Tech2']          // Liste des techniques utilisées
  // },
  //
  // =====================================
  // 🎨 LOGICIELS DISPONIBLES :
  // =====================================
  // - Photoshop      (Couleur : #7A9BB8 - Bleu)
  // - Illustrator    (Couleur : #C8956B - Orange)
  // - InDesign       (Couleur : #B8857A - Rose)
  // - Premiere Pro   (Couleur : #9B7B9A - Violet)
  // - After Effects  (Couleur : #9B7B9A - Violet)
  // - Lightroom      (Couleur : #7A9BB8 - Bleu)
  //
  // =====================================
  // 📝 CONSEILS :
  // =====================================
  // 1. Le 'nomduprojet' doit correspondre EXACTEMENT au nom du fichier
  //    Exemple : Si votre image s'appelle "Affiche Paris 2024.jpg"
  //    → utilisez 'afficheparis2024' (sans espaces ni caractères spéciaux)
  //
  // 2. Soyez précis dans vos descriptions (2-3 phrases)
  //
  // 3. Listez 3-5 techniques maximum pour rester lisible
  //
  // 4. N'oubliez pas les virgules entre chaque projet !

};

// ============================================
// 🎯 POUR AJOUTER VOTRE PROJET :
// ============================================
// 1. Copiez un exemple ci-dessus
// 2. Remplacez 'nomduprojet' par le nom de votre fichier (sans extension)
// 3. Personnalisez logiciels, description, date et techniques
// 4. Collez le tout dans projetsData du fichier projets.php
