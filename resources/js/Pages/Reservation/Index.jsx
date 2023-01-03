import AnchorButton from "@/Components/AnchorButton";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import PrimaryButton from "@/Components/PrimaryButton";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/inertia-react";
import { useForm } from "@inertiajs/inertia-react";
import { Input } from "@chakra-ui/react";

export default function Index(props) {
    const { data,setData, get } = useForm({
        subscriber: "",
        start_time:"",
    });

    const onSearch = (e) => {
        e.preventDefault();
        get(route("reservation.index", props.facility.id));
    };

    return (
        <AuthenticatedLayout auth={props.auth} errors={props.errors}>
            <Head title="予約状況" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <div className="flex justify-between md:mb-4">
                                <h1 className="font-bold text-2xl">
                                    {props.facility.name}の予約状況
                                </h1>
                                <div className="flex">
                                    <AnchorButton className="text-md">
                                        予約する
                                    </AnchorButton>
                                </div>
                            </div>

                            <form onSubmit={onSearch}>
                                <div className="mb-4 border-gray-200 rounded-t-md border-2 box-shadow pb-3">
                                    <div className="bg-gray-200 rounded-t-md font-bold p-3">
                                        <p>検索</p>
                                    </div>
                                    <div>
                                        <div className="grid grid-cols-3 p-3">
                                            <div className="flex p-3 items-center justify-center">
                                                <InputLabel className="mr-10">
                                                    予約者名
                                                </InputLabel>
                                                <TextInput
                                                    name="subscriber"
                                                    id="subscriber"
                                                    handleChange={(e) =>
                                                        setData(
                                                            "subscriber",
                                                            e.target.value
                                                        )
                                                    }
                                                ></TextInput>
                                            </div>
                                            <div className="flex p-3 items-center justify-center">
                                                <InputLabel className="mr-10">
                                                    予約日
                                                </InputLabel>
                                                <Input
                                                    size="md"
                                                    type="datetime-local"
                                                    id="start_time"
                                                    name="start_time"
                                                    onChange={(e) =>
                                                        setData(
                                                            "start_time",
                                                            e.target.value
                                                        )
                                                    }
                                                />
                                            </div>
                                        </div>

                                        <div className="text-center">
                                            <PrimaryButton type="submit">
                                                検索する
                                            </PrimaryButton>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <table className="table-auto w-full text-left whitespace-no-wrap mb-4">
                                <tbody>
                                    <tr className="border-2 border-gray-300 flex">
                                        <th className="w-1/6 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl border-r-2 border-gray-300">
                                            予約ID
                                        </th>
                                        <th className="w-1/5 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 border-r-2 border-gray-300">
                                            予約者名
                                        </th>
                                        <th className="w-1/5 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 border-r-2 border-gray-300">
                                            開始時間
                                        </th>
                                        <th className="w-1/5 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 border-r-2 border-gray-300">
                                            終了時間
                                        </th>
                                        <th className="w-1/3 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            目的
                                        </th>
                                    </tr>
                                    {props.reservations.map((reservation) => {
                                        return (
                                            <>
                                                <tr
                                                    className="border-2 border-gray-300 flex"
                                                    key={reservation.id}
                                                >
                                                    <td className="w-1/6 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-white rounded-tl rounded-bl border-r-2 border-gray-300">
                                                        {reservation.id}
                                                    </td>
                                                    <td className="w-1/5 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-white border-r-2 border-gray-300">
                                                        {reservation.user.name}
                                                    </td>
                                                    <td className="w-1/5 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-white border-r-2 border-gray-300">
                                                        {reservation.starttime}
                                                    </td>
                                                    <td className="w-1/5 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-white border-r-2 border-gray-300">
                                                        {reservation.endtime}
                                                    </td>
                                                    <td className="w-1/3 text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-white">
                                                        {reservation.perpose}
                                                    </td>
                                                </tr>
                                            </>
                                        );
                                    })}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
