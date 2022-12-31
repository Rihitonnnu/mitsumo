import AnchorButton from "@/Components/AnchorButton";

// 予約一覧の内容（設備名、今日の予約人数(これは後々実装予定)、予約一覧ボタン）
const Content = (props) => {
    const facilities = props.facilities.map((facility) => (
        <div
            className="flex justify-between py-5 border-b-2 border-double border-black items-center"
            key={facility.id}
        >
            <h2 className="text-xl">{facility.name}</h2>
            <div className="flex items-center">
                <p className="mr-6">本日の予約人数　　10人</p>
                <AnchorButton
                    href={route("reservation.index", {
                        facilityId: facility.id,
                    })}
                >
                    予約一覧
                </AnchorButton>
            </div>
        </div>
    ));

    return (
        <>
            <div>{facilities}</div>
        </>
    );
};

export default Content;
