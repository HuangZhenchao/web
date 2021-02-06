// NovelWriter.cpp : 定义 DLL 应用程序的导出函数。
//

#include "stdafx.h"
#include "NovelWriter.h"

HWND hWndCatalog;
HWND hWndSideItemPKB;
LRESULT CALLBACK    WndWndSideItemProc(HWND, UINT, WPARAM, LPARAM);

//
//  函数: RegWndSideItem()
//
//  目的: 注册侧边栏项目窗口类。
//
ATOM RegWndSideItem(HINSTANCE hInstance)
{
	WNDCLASSEXW wcex;

	wcex.cbSize = sizeof(WNDCLASSEX);
	wcex.style = CS_HREDRAW | CS_VREDRAW;
	wcex.lpfnWndProc = WndWndSideItemProc;
	wcex.cbClsExtra = 0;
	wcex.cbWndExtra = 0;
	wcex.hInstance = hInstance;
	wcex.hIcon = NULL;
	wcex.hCursor = LoadCursor(nullptr, IDC_HAND);
	wcex.hbrBackground = CreateSolidBrush(RGB(42, 51, 60));
	//wcex.hbrBackground = (HBRUSH)NULL_BRUSH;
	wcex.lpszMenuName = NULL;
	wcex.lpszClassName = L"WndSideItem";
	wcex.hIconSm = NULL;

	return RegisterClassExW(&wcex);
}


// 这是导出函数的一个示例。
NOVELWRITER_API int fnNovelWriter(void)
{
	RegWndSideItem(hModule);
	HWND hWndSide = FindWindow(L"WndSide", L"WndSide");
	hWndSideItemPKB = CreateWindowEx(NULL, L"WndSideItem", NULL, WS_CHILD | WS_VISIBLE,
		0, 10, 50, 50, hWndSide, NULL, hModule, NULL);
	ShowWindow(hWndSideItemPKB, SW_SHOW);
	DWORD dwCurrentProcessId = GetCurrentProcessId();
	wchar_t tempStr[10];
	_itow_s(dwCurrentProcessId, tempStr, 10);
	MessageBox(NULL, TEXT("DLL_PROCESS_ATTACH"), tempStr, MB_OK | MB_ICONINFORMATION);
}

//侧边栏按钮消息处理程序。
LRESULT CALLBACK WndWndSideItemProc(HWND hWndSideItem, UINT message, WPARAM wParam, LPARAM lParam)
{
	UNREFERENCED_PARAMETER(lParam);
	switch (message)
	{
	case WM_CREATE:
	{

	}
	case WM_SIZE:
	{

	}
	case WM_LBUTTONDOWN:
	{
		//hWndCatalog = CreateWindowEx(NULL, L"WndCatalog", NULL, WS_CHILD | WS_VISIBLE,
		//	50, 0, 100, WndIni.WndMainHeight, hWndMain, NULL, hInst, NULL);
		/*
		if (hWndSideItem == hWndSideItemNovel)
		{
		hWndCatalog = CreateWindowEx(NULL, L"WndCatalog", NULL, WS_CHILD | WS_VISIBLE,
		50, 0, 100, WndIni.WndMainHeight, hWndMain, NULL, hInst, NULL);
		//hWndFileList
		//hWndSpiltter
		//hWndEdit
		}*/
	}
	break;
	case WM_COMMAND:
	{

	}
	break;
	case WM_PAINT:
	{
		PAINTSTRUCT ps;

		HDC hdc = BeginPaint(hWndSideItem, &ps);
		// TODO: 在此处添加使用 hdc 的任何绘图代码...

		//if (hWndSideItem == hWndSideItemPKB) {
		//HBRUSH brush = CreateSolidBrush(RGB(255,255,255));
		HPEN hpen = CreatePen(PS_SOLID, 2, RGB(255, 255, 255));
		//SelectObject(hdc, brush);
		SelectObject(hdc, hpen);
		SelectObject(hdc, GetStockObject(NULL_BRUSH));
		Ellipse(hdc, 10, 10, 40, 40);

		//DeleteObject(hpen);
		//}
		EndPaint(hWndSideItem, &ps);


	}
	break;
	case WM_DESTROY:
		//WriteWndIni();
		PostQuitMessage(0);
		break;
	default:
		return DefWindowProc(hWndSideItem, message, wParam, lParam);
	}
	return 0;
}