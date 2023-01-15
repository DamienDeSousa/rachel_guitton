import styles from './index.module.css'

export default function HeaderBanner() {
  return (
    <div
      style={{
        display: 'flex',
        flexDirection: 'row',
        justifyContent: 'center',
      }}
    >
      <h1 className={styles.headerbanner_text}>RACHELGUITTON</h1>
    </div>
  )
}
