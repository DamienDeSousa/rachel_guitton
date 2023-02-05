import styles from '../../styles/Menu.module.scss'

export default function Menu() {
  return (
    <div className={styles.menu}>
      <div className={styles.menubanner}></div>
      <div className={styles.menu__items}>
        <a href="#home" style={{ textDecoration: 'unset' }}>
          <h2 className={`${styles.menu__item} ${styles['menu__item--active']}`}>ACCUEIL</h2>
        </a>
        <a href="#about" style={{ textDecoration: 'unset' }}>
          <h2 className={styles.menu__item}>A PROPOS</h2>
        </a>
        <a href="#services" style={{ textDecoration: 'unset' }}>
          <h2 className={styles.menu__item}>SERVICES</h2>
        </a>
        <h2 className={styles.menu__item}>TÉMOIGNAGES</h2>
        <h2 className={styles.menu__item}>PORTFOLIO</h2>
        <h2 className={styles.menu__item}>CONTACTS</h2>
      </div>
    </div>
  )
}
