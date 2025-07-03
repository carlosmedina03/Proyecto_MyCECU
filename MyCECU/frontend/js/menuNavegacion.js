document.addEventListener('DOMContentLoaded', ajustarPadding);
window.addEventListener('resize', ajustarPadding);

function ajustarPadding() {
  const nav = document.querySelector('.navegacion');
  if (!nav) return;

  const navHeight = nav.offsetHeight;

  const bodyChildren = Array.from(document.body.children);
  const navIndex = bodyChildren.indexOf(nav);

  for (let i = navIndex + 1; i < bodyChildren.length; i++) {
    const el = bodyChildren[i];
    const style = getComputedStyle(el);
    if (style.display !== 'none' && style.visibility !== 'hidden') {
      el.style.paddingTop = navHeight + 'px';
      break;
    }
  }
}
