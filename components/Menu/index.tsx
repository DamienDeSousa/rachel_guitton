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
        <h2 className={`${styles.menu_item} ${styles.menu_item_active}`}>HOME</h2>
        <h2 className={styles.menu_item}>ABOUT</h2>
        <h2 className={styles.menu_item}>SERVICES</h2>
        <h2 className={styles.menu_item}>TESTIMONIALS</h2>
        <h2 className={styles.menu_item}>PORTFOLIO</h2>
        <h2 className={styles.menu_item}>CONTACTS</h2>
      </div>
    </div>
  )
}
