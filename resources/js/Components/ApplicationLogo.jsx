import Logo from "../../../public/img/mitsumo_logo_small.png";

export default function ApplicationLogo({ className }) {
    return <img src={Logo} alt="ロゴ" className={className} />;
}
