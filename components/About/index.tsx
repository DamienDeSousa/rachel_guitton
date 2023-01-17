import Image from 'next/image'
import aboutPicture from '../../public/images/about.jpg'
import styles from '../../styles/About.module.scss'

export default function About() {
  const paragraphs = [
    "Infographiste designer trans-média titulaire d'une licence d'art plastique spécialisé dans la photographie et" +
      "l'édition, un master 1 en pratique de l'accrochage (scénographie) et titulaire d'une licence en conception" +
      'audiovisuel et nouveau média.',
    'Je saurais, vous accompagnez dans des projets qui mixent différents supports, du plastique au numérique en' +
      'passant par la réalité mixte. Du physique au virtuel.',
  ]
  return (
    <div className={styles.about} id="about">
      <div>
        <Image src={aboutPicture} alt="Rachel GUITTON" width={300} height={300} className={styles.about__picture} />
        <div className={styles.paragraphs}>
          {paragraphs.map((paragraph, index) => (
            <p
              key={index}
              className={`${styles.paragraphs__paragraph} ${index === 0 ? styles['paragraphs__paragraph--first'] : ''}`}
            >
              {paragraph}
            </p>
          ))}
        </div>
      </div>
    </div>
  )
}
