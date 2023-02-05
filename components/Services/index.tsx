import styles from '../../styles/Services.module.scss'
import numericIdentity from '../../public/images/services/identité_numerique_identitédemarque.png'
import shootingPhoto from '../../public/images/services/shooting_photo_video.png'
import videoSupport from '../../public/images/services/montage_video_derush_son&co.png'
import graphicalCharter from '../../public/images/services/charte_graphique_cahierdescharges_auditclient.png'
import interactivity from '../../public/images/services/interactivité_RA_VR.png'
import model from '../../public/images/services/maquette_toutsupport.png'
import designCreation from '../../public/images/services/creation_design_logo_typo&co.png'
import presentation from '../../public/images/services/presentation_produit_multisupport_mockup.png'
import Image from 'next/image'

export default function Services() {
  const services = [
    {
      file: numericIdentity,
      text: 'Accompagnement création de votre identité en ligne',
    },
    {
      file: shootingPhoto,
      text: 'Prise de vue de vos produits',
    },
    {
      file: videoSupport,
      text: 'Réalisation sous le support vidéo',
    },
    {
      file: graphicalCharter,
      text: 'Accompagnement dans la cohérence de votre visuel',
    },
    {
      file: model,
      text: 'Accompagnement dans la création graphique sur tout support',
    },
    {
      file: interactivity,
      text: 'Accompagnement dans un projet interactif RA ou VR',
    },
    {
      file: designCreation,
      text: 'Accompagnement création graphique (logo, typographie...)',
    },
    {
      file: presentation,
      text: 'Présentation d’un produit sur support digital',
    },
  ]

  return (
    <div className={styles.services} id="services">
      <h2 className={styles.services__header}>SERVICES</h2>
      <div className={styles.services__list}>
        {services.map((service, index) => (
          <div key={index} className={styles.services__item}>
            <Image src={service.file} alt={service.text} width={150} height={150} />
            <p>{service.text}</p>
          </div>
        ))}
      </div>
    </div>
  )
}
