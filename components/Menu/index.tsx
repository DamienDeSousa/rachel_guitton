import styles from './index.module.css'

export default function Menu() {
  return (
    <div
      style={{
        display: 'flex',
        flexDirection: 'column',
      }}
    >
      <div
        style={{
          height: '50px',
          width: '100vw',
          backgroundColor: '#949494',
          maxWidth: '100%',
        }}
      ></div>
      <div
        style={{
          padding: '30px 0 20px 10px',
          display: 'flex',
          flexDirection: 'column',
          backgroundColor: '#C6C4C5',
        }}
      >
        <a href="#home" style={{ textDecoration: 'unset' }}>
          <h2 className={`${styles.menu_item} ${styles.menu_item_active}`}>ACCUEIL</h2>
        </a>
        <a href="#about" style={{ textDecoration: 'unset' }}>
          <h2 className={styles.menu_item}>A PROPOS</h2>
        </a>
        <h2 className={styles.menu_item}>SERVICES</h2>
        <h2 className={styles.menu_item}>TÉMOIGNAGES</h2>
        <h2 className={styles.menu_item}>PORTFOLIO</h2>
        <h2 className={styles.menu_item}>CONTACTS</h2>
      </div>
    </div>
  )
}
