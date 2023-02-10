import styles from '../../styles/Services.module.scss'

export default function Services() {
  const services = [
    {
      title: 'Identité Numérique',
      text: 'Accompagnement création de votre identité en ligne',
    },
    {
      title: 'Shooting Photo',
      text: 'Prise de vue de vos produits',
    },
    {
      title: 'Montage Vidéo',
      text: 'Réalisation sous le support vidéo',
    },
    {
      title: 'Charte Graphique',
      text: 'Accompagnement dans la cohérence de votre visuel',
    },
    {
      title: 'Maquette',
      text: 'Accompagnement dans la création graphique sur tout support',
    },
    {
      title: 'Intéractivité',
      text: 'Accompagnement dans un projet interactif RA ou VR',
    },
    {
      title: 'Création Design',
      text: 'Accompagnement création graphique (logo, typographie...)',
    },
    {
      title: 'Présentation',
      text: 'Présentation d’un produit sur support digital',
    },
  ]

  return (
    <div className={styles.services} id="services">
      <h2 className={styles.services__header}>SERVICES</h2>
      <div className={styles.services__list}>
        {services.map((service, index) => (
          <div key={index} className={styles.services__item}>
            <div className={styles.services__item}>
              <h3>{service.title}</h3>
            </div>
            <p>{service.text}</p>
          </div>
        ))}
      </div>
    </div>
  )
}
