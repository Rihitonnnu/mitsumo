import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import {
    ChakraProvider,
    Alert,
    AlertIcon,
    useDisclosure,
    CloseButton,
} from "@chakra-ui/react";
import { Head } from "@inertiajs/inertia-react";
import Content from "./Content";

export default function Index(props) {
    // ログインした際のフラッシュメッセージ
    const { isOpen: isVisible, onClose } = useDisclosure({
        defaultIsOpen: true,
    });

    return (
        <ChakraProvider>
            <AuthenticatedLayout auth={props.auth} errors={props.errors}>
                <Head title="設備一覧" />

                {/* ログインのセッションがある状態かつisVisibleがtrueの時にフラッシュメッセージを表示する */}
                {props.status != null && isVisible == true ? (
                    <Alert status="success">
                        <AlertIcon />
                        {props.status}
                        <CloseButton
                            position="relative"
                            right={-1}
                            onClick={onClose}
                        />
                    </Alert>
                ) : null}

                {/* 設備一覧表示 */}
                <div className="py-12">
                    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div className="bg-white overflow-hidden shadow-md sm:rounded-lg">
                            <div className="p-6 text-gray-900">
                                <Content facilities={props.facilities}/>
                            </div>
                        </div>
                    </div>
                </div>
            </AuthenticatedLayout>
        </ChakraProvider>
    );
}
