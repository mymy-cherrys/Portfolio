# 🎨 Système de Modal pour vos Projets - Mode d'emploi

## ✨ Ce qui a été créé :

### 1. **Modal Moderne et Ergonomique**
- **Image à gauche** (70% de largeur) - Grande et mise en valeur
- **Panneau d'informations à droite** (30% de largeur) avec :
  - Titre du projet
  - Tags colorés des logiciels utilisés (vos couleurs DA : bleu, orange, rose, violet)
  - Description détaillée
  - Informations techniques (année, techniques)
  - Design épuré et professionnel

### 2. **Design Responsive**
- **Sur PC** : Image à gauche, infos à droite
- **Sur Mobile** : Image en haut, infos en bas (empilés)
- Animations fluides et bouton de fermeture qui tourne au hover

### 3. **Tags Personnalisés**
Les tags utilisent vos couleurs DA :
- 🔵 Photoshop / Lightroom : Bleu (#7A9BB8)
- 🟠 Illustrator : Orange (#C8956B)
- 🟣 Premiere Pro / After Effects : Violet (#9B7B9A)
- 🌸 InDesign : Rose (#B8857A)

---

## 📝 Comment ajouter vos projets :

### Étape 1 : Ouvrez `projets.php`

Trouvez cette section (ligne ~120) :
```javascript
const projetsData = {
  // Vos projets ici
};
```

### Étape 2 : Ajoutez vos projets

Pour chaque image dans votre dossier `proj/`, ajoutez une entrée :

```javascript
const projetsData = {
  'nomdevotrefichier': {
    logiciels: ['Photoshop', 'Illustrator'],
    description: 'Votre description détaillée du projet. Expliquez le concept, la technique, l\'objectif.',
    date: '2024',
    techniques: ['Photomontage', 'Retouche', 'Color grading']
  },
};
```

### ⚠️ IMPORTANT : Le nom du projet

Si votre image s'appelle `"Affiche Concert Jazz.jpg"` :
- Utilisez : `'affichec oncertjazz'` (sans espaces, sans extension, tout en minuscules)

---

## 🎯 Exemple Complet

```javascript
const projetsData = {
  
  // Projet 1
  'postercinema2024': {
    logiciels: ['Photoshop', 'Illustrator'],
    description: 'Affiche cinématographique inspirée du film noir des années 50. Utilisation de textures vintage et de typographies classiques pour recréer l\'atmosphère mystérieuse de l\'époque.',
    date: '2024',
    techniques: ['Photomontage', 'Effets vintage', 'Typographie', 'Masques']
  },
  
  // Projet 2
  'identitevisuellebio': {
    logiciels: ['Illustrator', 'InDesign'],
    description: 'Création complète de l\'identité visuelle pour une marque bio : logo, carte de visite, packaging. Palette naturelle et formes organiques pour refléter les valeurs écologiques.',
    date: '2023',
    techniques: ['Vectorisation', 'Design d\'identité', 'Mise en page']
  },
  
  // Projet 3
  'clipmusical': {
    logiciels: ['Premiere Pro', 'After Effects'],
    description: 'Montage d\'un clip musical avec motion design synchronisé. Création d\'effets visuels dynamiques qui épousent le rythme et l\'énergie du morceau.',
    date: '2024',
    techniques: ['Montage vidéo', 'Motion design', 'VFX', 'Color grading']
  }
  
};
```

---

## 🎨 Personnalisation des couleurs

Si vous voulez modifier les couleurs des tags, trouvez cette section dans `projets.php` :

```javascript
const couleursTags = {
  'Photoshop': '#7A9BB8',      // Changez ici
  'Illustrator': '#C8956B',    // Changez ici
  // etc...
};
```

---

## 📱 Résultat Final

### Sur PC :
```
┌─────────────────────────────────────────┐
│                          │              │
│                          │  Titre       │
│      IMAGE GRANDE        │  [Tags]      │
│        70%               │  Description │
│                          │  Infos       │
│                          │     30%      │
└─────────────────────────────────────────┘
```

### Sur Mobile :
```
┌──────────────────┐
│                  │
│     IMAGE        │
│                  │
├──────────────────┤
│  Titre           │
│  [Tags]          │
│  Description     │
│  Infos           │
└──────────────────┘
```

---

## ✅ Checklist

- [ ] Vérifiez que vos images sont dans le dossier `proj/`
- [ ] Ajoutez chaque projet dans `projetsData`
- [ ] Utilisez le nom du fichier exact (sans extension)
- [ ] Testez sur PC et mobile
- [ ] Personnalisez les descriptions

---

## 🚀 Conseils

1. **Descriptions** : 2-3 phrases suffisent
2. **Techniques** : Maximum 4-5 pour rester lisible
3. **Tags** : Listez seulement les logiciels principaux utilisés
4. **Cohérence** : Gardez le même niveau de détail pour tous les projets

---

Besoin d'aide ? Tous les exemples sont dans le fichier `PROJETS_EXEMPLE.js` ! 🎉
